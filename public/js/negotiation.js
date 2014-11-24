/* "Working" functions or those with bussiness logic */

function renderNegotiations() {
	$.get('/negotiation', function(data) {
		$('.tab-pane').removeClass('active');
		$('#main-tabs li').removeClass('active');
		$('#negotiations-tab').addClass('active');
		$('#negotiations').addClass('active');
		$('#negotiations').html(data['view']);
	});
}

/* --------------------------------------------------------------------------------------------------------------------/*

/* "Assign to view" or "respond to click" functions */

/* Change to cart tab */
$(document).on('click', '#negotiations-tab a', function(event) {
	event.preventDefault();
	renderNegotiations();
});