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

	$('.insurance-upload-button').click(function(e) {
        e.preventDefault();
        var doc = wp.media({ 
            title: 'Upload Document',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_doc = doc.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            var docObject = uploaded_doc.toJSON();

            console.log( docObject );

            // Snag insurance URL and name fields
            var insuranceURL = jQuery( '#insurance-upload-url' );
            var insuranceName = jQuery( '#insurance-upload-name' );

            // Set documents's URL and name input fields
            insuranceURL.val( docObject.url );
            insuranceName.val( docObject.filename );

        });
    });

    $('.supporting-upload-button').click(function(e) {
        e.preventDefault();
        var doc = wp.media({ 
            title: 'Upload Document',
            // mutiple: true if you want to upload multiple files at once
            multiple: false
        }).open()
        .on('select', function(e){
            
            // This will return the selected image from the Media Uploader, the result is an object
            var uploaded_doc = doc.state().get('selection').first();
            // We convert uploaded_image to a JSON object to make accessing it easier
            var docObject = uploaded_doc.toJSON();

            // Snag supporting doc URL and name fields
            var supportingURL = jQuery( '#supporting-upload-url' );
            var supportingName = jQuery( '#supporting-upload-name' );

            // Set documents's URL and name input fields
            supportingURL.val( docObject.url );
            supportingName.val( docObject.filename );

        });
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
		naics    : jQuery("#naics-selector").val(),
		revenue  : jQuery("#revenue-selector").val()
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
		jQuery("#email-fields").css("display","block");
	});
}