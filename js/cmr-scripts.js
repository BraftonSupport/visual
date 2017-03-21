jQuery(document).ready(function($) {

	$("#service-selector").change( function(){
		var selectedService = $("#service-selector").val();
		switch( selectedService ) {
			case "GB":
				$("#gb-option").css('display', 'block');
				$("#pc-option").css('display', 'none');
				$("#mm-option").css('display', 'none');
				break;
			case "PC":
				$("#gb-option").css('display', 'none');
				$("#pc-option").css('display', 'block');
				$("#mm-option").css('display', 'none');
				break;
			case "MM":
				$("#gb-option").css('display', 'none');
				$("#pc-option").css('display', 'none');
				$("#mm-option").css('display', 'block');
				break;
		}
	});

	// launch ajax call when naics-cat-selector changes
	$("#naics-cat-selector").change( function(){
		var selectedCat = $("#naics-cat-selector").val();
		populateNAICS( selectedCat );
	});

});

// AJAX call to populate industries in a given category
function populateNAICS( cat ) {
	console.log("loading industries!");
	var naicsData = {
		naicsCat : cat
	};
	var toPass = {
		action	: "get_naics",
		data    : naicsData
	};

	// make the call
	jQuery.post( ajaxurl, toPass ).done( function(res) {
		console.log(res);
		jQuery("#pc-subcat").html(res);
	});
}