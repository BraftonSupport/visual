jQuery(document).ready(function($){
	$('.option.property .inner').click(function() {
		$('#prop-form').show();
		$(this).hide();
		$('.option.group').hide();
		$('.option.retirement').hide();
		$('#prop-form').fadeIn();
	});
	$('.option.retirement .inner').click(function() {
		$('#ret-form').show();
		$(this).hide();
		$('.option.property').hide();
		$('.option.group').hide();
		$('#ret-form').fadeIn();
	});
	$('.option.group .inner').click(function() {
		$('#group-form').show();
		$(this).hide();
		$('.option.property').hide();
		$('.option.retirement').hide();
		$('#group-form').fadeIn();
	});
	$('a.back').click(function() {
		$('.home-form').hide();
		$('.option .inner').fadeIn();
		$('.option').fadeIn();
	});
});