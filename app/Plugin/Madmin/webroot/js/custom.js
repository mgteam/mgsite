$(function() {

	// add calender to the textfield.
	$('.datepicker').datepicker({
		dateFormat: 'dd-mm-yy',
		changeMonth: true,
		changeYear: true,
		minDate: 'Now'
	});
});