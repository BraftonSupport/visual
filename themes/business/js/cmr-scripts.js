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

	$("#show-office-info-btn").click( function(){
		console.log("Show office button clicked!");
		populateOffices();
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

// AJAX call to populate a list of offices with details
function populateOffices() {
	console.log("Entered populateOffices");
	var formData = {
		service  : jQuery("#service-selector").val(),
		employee : jQuery("#employee-selector").val(),
		naics    : jQuery("#naics-selector").val()
	};
	//console.log(formData);
	var toPass = {
		action : "get_office",
		data   : formData
	};

	// make the call
	jQuery.post( ajaxurl, toPass ).done( function(res) {
		console.log(res);
		jQuery("#office-table-holder").html(res);
	});
}