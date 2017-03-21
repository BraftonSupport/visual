<?php
/*
Author: John Parks
Description: I DO know her
Version: 1.0
*/


/*
--------------------------------------
COMMENCE ADMIN PAGE FUNCTIONS
--------------------------------------
*/

// add enqueue scripts for my ajax and javascript
add_action( 'wp_admin_enqueue_scripts', 'office_details_scripts' );
function office_details_scripts() {
	wp_enqueue_script( 'cmr-script', get_template_directory_uri() . '/js/cmr-scripts.js' );
	//wp_localize_script( 'cmr-script', 'cmr_ajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
}


add_action( 'admin_menu', 'add_office_details_page' );

function add_office_details_page() {
	add_menu_page( 'Get Office Details and Send Email', 'Office Details', 'manage_options', 'office-details', 'populate_office_page', '', 99 );
}

// function for populating the page that displays office details and sends bulk emails
function populate_office_page() {
	wp_enqueue_script( 'cmr-script', get_template_directory_uri() . '/js/cmr-scripts.js' );
	?>

	<div class="office-wrap">
		<h2>Welcome to the office details page!</h2>

		<p>Service Type</p>
		<select id="service-selector">
			<option value="">Select a Service</option>
			<option value="GB">GB</option>
			<option value="PC">PC</option>
			<option value="MM">MM</option>
		</select>

		<div id="gb-option" style="display:none;">
			<p>Number of Employees</p>
			<select id="employee-selector">
			<?php
				$numEmployees = getNumEmployees();
				for( $cntr=0; $cntr < count($numEmployees); $cntr++ ) {
					// perform three replaces to make the value readable
					$readable = formatEmployeeRange( $numEmployees[$cntr] );
					echo "<option value='" . $numEmployees[$cntr] . "'>" . $readable . "</option>";
				}
				/*foreach( $numEmployees as $col ) {
					echo "<option value='" . $col > "'>" . $col . "</option>";
				}*/
				?>
			</select>
		</div>

		<div id="pc-option" style="display:none;">
			<p>NAICS Categories</p>
			<select id="naics-cat-selector">
				<option value="">Select a Category</option>
				<?php
				$naicsCats = getCatNAICS();
				foreach( $naicsCats as $cat ) {
					echo "<option value='" . $cat['naics_category_id'] . "'>" . $cat['naics_category_name'] . "</option>";
				}
				?>
			</select>

			<div id="pc-subcat"></div>
		</div>

		<div id="mm-option" style="display:none;">
			<p>Show me what you got.</p>
		</div>
	</div>

	<?php
}


// function for spitting out any variable in a formatted manner
function printDat( $toPrint ) {
	echo "<pre>";
	print_r( $toPrint );
	echo "</pre>";
}

/*
--------------------------------------
COMMENCE DB CONNECTION FUNCTIONS
--------------------------------------
*/

// function to establish DB connection, to be used in future functions
function establish_connection() {
	$servername = "69.174.52.217";
	$username = "policy8_brafton";
	$password = "!H}GDB~m]1_6";
	$dbname = "policy8_newpsdb";

	$conn = new mysqli( $servername, $username, $password, $dbname );

	// check the connection
	if ( $conn->connect_error ) {
		die( "<p>Connection failed! Error is " . $conn->connect_error . "</p>");
	}

	return $conn;
}

// looks at the columns of the "numberoflives" table
function getNumEmployees() {
	$conn = establish_connection();
	$query = "desc tbl_br_office_gb_numberoflives";

	$fieldsArray = array();

	$fieldsToIgnore = ['officeid', 'servicetypeid', 'minimum', 'IsUpdated'];

	$res = $conn->query( $query );

	while( $row = $res->fetch_assoc() ) {
		if ( !in_array( $row['Field'], $fieldsToIgnore ) ) {
			$fieldsArray[] = $row['Field'];
		}
	}

	return $fieldsArray;
}

// function to format one of the employee ranges into a human readable format
function formatEmployeeRange( $range ) {
	$firstChange = str_replace( "f", "From ", $range );
	$secondChange = str_replace( "t", " to ", $firstChange );
	$thirdChange = str_replace( "over", "Over ", $secondChange );

	return $thirdChange;
}

function getCatNAICS() {
	$conn = establish_connection();
	$table = "naics_category";
	$query = "SELECT naics_category_id, naics_category_name FROM $table";

	$res = $conn->query( $query );

	$cats = array();

	while( $row = $res->fetch_assoc() ) {
		$cats[] = $row;
	}

	return $cats;
}

// function to grab NAICS, based on the passed in category id
function getNAICS( $id ) {
	// check if we have an ID...if not, this is an AJAX call
	if ( $id == null ) {
		$id = $_POST['data']['naicsCat'];
	}
	$conn = establish_connection();
	$table = "naics";
	$query = "SELECT id, name FROM $table WHERE naics_category_id = $id";

	$res = $conn->query( $query );

	$industries = array();

	while( $row = $res->fetch_assoc() ) {
		$industries[] = $row;
	}

	//return $industries;

	// build out a select list, echo it out
	$html = "";
	$html .= "<select id='naics-selector'>";
	foreach( $industries as $industry) {
		$html .= "<option value='" . $industry['id'] . "'>" . $industry['name'] . "</option>";
	}
	$html .= "</select>";

	echo $html;

	if ( $_POST ) {
		wp_die();
	}
}
//add_action( "wp_ajax_nopriv_get_naics", "getNAICS" );
add_action( "wp_ajax_get_naics", "getNAICS" );

// function to grab office IDs for GB
// takes an employee range (ie column name from "number_of_lives") as input, and grabs any offices with a value in that column != 0 or null
// returns an array of officeids
function getGBOfficeIDs( $col ) {
	$conn = establish_connection();
	$table = "tbl_br_office_gb_numberoflives";
	$query = "SELECT officeid FROM $table WHERE $col != 0 && $col IS NOT NULL";

	$res = $conn->query( $query );

	$ids = array();

	while( $row = $res->fetch_assoc() ) {
		$ids[] = $row['officeid'];
	}

	return $ids;
}
//add_action( "wp_ajax_nopriv_get_gb_ids", "getGBOfficeIDs" );
add_action( "wp_ajax_get_gb_ids", "getGBOfficeIDs" );

// function to grab office IDs for PC
// takes an industry id (corresponds to "id" in the table "naics"), and finds any office IDs that share that naics_id in the table "tbl_br_office_sic"
// returns array of office ids
function getPCOfficeIDs( $naicsID ) {
	$conn = establish_connection();
	$table = "tbl_br_office_sic";
	$query = "SELECT officeid FROM $table WHERE naics_id = $naicsID";

	$res = $conn->query( $query );

	$ids = array();

	while ( $row = $res->fetch_assoc() ) {
		$ids[] = $row['officeid'];
	}

	return $ids;
}
//add_action( "wp_ajax_nopriv_get_pc_ids", "getPCOfficeIDs" );
add_action( "wp_ajax_get_pc_ids", "getPCOfficeIDs" );

// function to grab office details
// takes an office ID and servicetypeid (of either GB, MM or PC), and stiches together two or three tables to build out an array of offices with what details are available
// returns an array of row data...what each row contains, I've yet to fully establish
function getOfficeInfo( $officeIDs, $service ) {
	// string converted array of IDs, to be used in a MySQL 'IN' statement
	$inString = implode( ',', $officeIDs );
	// variables to contain table names
	$office = "tbl_br_office";
	$sic = "tbl_br_office_sic";
	$details = "tbl_br_office_details";
	$contact = "tbl_br_office_contact";

	$query = "";
	// add SELECT statements to query for all relevant tables
	// build "office" adds
	$officeSelect = $office . ".companyname, " . $office . ".address1, " . $office . ".address2, " . $office . ".city, " . $office . ".state, " . $office . ".zip, " . $office . ".country";
	// build "contact" adds
	$contactSelect = $contact . ".maincontact, " . $contact . ".website, " . $contact . ".email, " . $contact . ".telephone, " . $contact . ".fax";

	// build FROM statement
	$from = "FROM $office";
	$from .= " INNER JOIN $contact ON " . $contact . ".officeid = " . $office . ".officeid";

	// build WHERE statement
	$where = "WHERE " . $office . ".officeid IN (" . $inString . ") && " . $office . ".servicetypeid = '" . $service . "'";

	// lastly, string all that together into a single query
	$query .= "SELECT " . $officeSelect . ", " . $contactSelect . " " . $from . " " . $where;

	printDat( $query );

	$conn = establish_connection();

	$res = $conn->query( $query );
	//printDat($res);
	$offices = array();

	while( $row = $res->fetch_assoc() ) {
		$offices[] = $row;
	}

	return $offices;
}
//add_action( "wp_ajax_nopriv_get_office", "getOfficeInfo" );
add_action( "wp_ajax_get_office", "getOfficeInfo" );