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

});