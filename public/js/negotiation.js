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

/* Manager takes negotiation */
$(document).on('click', '#take-negotiation', function(event) {
	event.preventDefault();
	var li = $(this).closest('li');
	$.get('/negotiation/take', $(this).find('form').serialize(), function(data) {
		if (data['first']) {
			$('#active-orders-info').remove();
			$('#list-body').html(data['view']);
		} else {
			$('#negotiations-list').append(data['view']);
		}
		var executed = false
		li.wrapInner('<div style="display: block;" />')
			.parent()
			.find('li > div')
			.slideUp(200)
			.delay(200, function() {
				if (!executed) {
					li.remove();
					executed = true;
					if (data['no_more_waiting_negotiations']) {
						$('#negotiations-waiting-title')
							.after('<hr><p class="alert alert-info text-center">There are no negotiations pending currently.</p>');
					}
				}
			});
	});
})