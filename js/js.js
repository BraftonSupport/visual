jQuery(document).ready(function($){
	if ($( "#ssbutton" ).prop( "checked" )) {
		$(".ss").show();
	}
	$( "#ssbutton" ).click(function() {
		$(".ss").toggle("slow");
	});
});