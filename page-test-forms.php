<?php

get_header();

?>

<h1>This is a page for testing form functions</h1>

<?php

/*echo "<h3>Testing getNAICS</h3>";
$catNAICS = getCatNAICS();

foreach( $catNAICS as $cat ) {
	$catName = $cat['naics_category_name'];
	$catID = $cat['naics_category_id'];
	echo "Fetching Industries for $catName";
	$industry = getNAICS( $catID );
	printDat( $industry );
}*/

echo "<h3>testing getGBOfficeIDs</h3>";

getGBOfficeIDs( "f1t100" );

?>

<?php

get_footer();

?>