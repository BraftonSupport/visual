jQuery(document).ready(function($){
	// Preload background images 
	var images = [];
	function preload() {
	    for (var i = 0; i < arguments.length; i++) {
	        images[i] = new Image();
	        images[i].src = preload.arguments[i];
	    }
	}
	preload(
		"http://design.brafton.com/cmr/wp-content/uploads/2017/03/property.jpeg",
		"http://design.brafton.com/cmr/wp-content/uploads/2017/03/group.jpeg",
		"http://design.brafton.com/cmr/wp-content/uploads/2017/03/retirement.jpeg"
	)
	// Define actions for each form icon
	$('.option.property .inner').click(function() {
		$('#prop-form').show();
		$(this).hide();
		$('.text').hide();
		$('.option.group').hide();
		$('.option.retirement').hide();
		$('#prop-form').fadeIn();
		$('.background').addClass('property');
	});
	$('.option.retirement .inner').click(function() {
		$('#ret-form').show();
		$(this).hide();
		$('.text').hide();
		$('.option.property').hide();
		$('.option.group').hide();
		$('#ret-form').fadeIn();
		$('.background').addClass('retirement');
	});
	$('.option.group .inner').click(function() {
		$('#group-form').show();
		$(this).hide();
		$('.text').hide();
		$('.option.property').hide();
		$('.option.retirement').hide();
		$('#group-form').fadeIn();
		$('.background').addClass('group');
	});
	// Reset everything when the user clicks the back button
	$('a.back').click(function() {
		$('.home-form').hide();
		$('.option .inner').fadeIn();
		$('.option').fadeIn();
		$('.text').fadeIn();
		$('.background').removeClass('property');
		$('.background').removeClass('retirement');
		$('.background').removeClass('group');
	});
	// Hide the last step of the form when user presses second back button
	$('a.drop-back').click(function() {
		$('.rest').hide();
		$('.dropdown').fadeIn();
	});
	// Display the last step of the form; hide dropdown
	$('a.next').click(function() {
		$('.dropdown').hide();
		$('.rest').fadeIn();
	});
});