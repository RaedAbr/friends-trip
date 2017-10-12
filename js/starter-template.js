$(document).ready(function(){
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	});

	$('#add-event').on('click', function() {
		$('#dynamic-ajax-content').hide();
		$('#dynamic-ajax-content').load('add_event_view.php');
		$('#dynamic-ajax-content').fadeIn();
		$('.tooltip').remove();
	});
});