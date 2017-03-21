<?php

get_header();

?>

<h1>This is a page for testing form functions</h1>

<?php

printDat(getNumEmployees());

//echo "<h3>Testing getNAICS</h3>";
//$catNAICS = getCatNAICS();

//printDat($catNAICS);

/*foreach( $catNAICS as $cat ) {
	$catName = $cat['naics_category_name'];
	$catID = $cat['naics_category_id'];
	echo "Fetching Industries for $catName";
	$industry = getNAICS( $catID );
	printDat( $industry );
}*/

//$industry = getNAICS( 50 );

//printDat($industry);

getNAICS( 50 );

//echo "<h3>testing getOfficeInfo using getPCOfficeIDs(111336)</h3>";

//$officeIDs = getPCOfficeIDs( 111336 );

//getOfficeInfo( $officeIDs, "PC" );

?>

<?php

get_footer();

?>