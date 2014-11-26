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

/* Show battery */
$(document).on('click', 'a[name=battery]', function(event) {
	event.preventDefault();
	var parent = $(this).parent().parent().parent();
	var id = parent.find("input[name='battery-id']").val();
	if (parent.find('div#show').length) {
		parent.find('div#show').slideUp('200',function() {
			parent.find('div#show').remove();
		});
	} else {
		$.get('/battery/' + id, function(data) {
			parent.append(data['view']);
			parent.find('div#show').hide().slideDown('400');
		});
	}
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
		var executed = false;
		var no_more_waiting_negotiations = data['no_more_waiting_negotiations'];

		li.wrapInner('<div style="display: block;" />')
		 	.find('div')
		 	.slideUp(200)
			.delay(200, function() {
				if (!executed) {
					li.remove();
					executed = true;
					if (no_more_waiting_negotiations) {
						$('#negotiations-waiting-title')
							.after('<hr><p class="alert alert-info text-center">There are no negotiations pending currently.</p>');
					}
				}
			});
	});
});

/* Display negotiation form */
$(document).on('click', '#display-negotiation', function(event) {
	event.preventDefault();
	var id = $(this).find("input[name='negotiation-id']").val();
	var parent = $(this).parent().parent();
	if (parent.find('div#show-negotiation').length) {
		parent.find('div#show-negotiation').slideUp('200',function() {
			parent.find('div#show-negotiation').remove();
		});
	} else {
		$.get('/negotiation/negotiate', $(this).find('form').serialize(), function(data) {
			parent.append(data['view']);
			parent.find('div#show-negotiation').hide().slideDown('400');
		});
	}
});

/* Bootstrap popover when clicking counter-offer */
$(document).on('click', '#counter-offer', function(e) {
	e.preventDefault();
	$.get('/negotiation/counter_offer_form', function(data) {
		form = data['form'];
	});
	$(this).popover({
		html: true,
		placement: 'right',
		content: form,
		container: 'body',
		trigger: 'click'
	}).popover('toggle');
});

/* Bootstrap tooltip for accept offer */
$(document).on('mouseover', '#accept-offer', function() {
	$(this).tooltip({
		placement: 'bottom',
		title: 'Accept offer',
		container: 'body'
	}).tooltip('show');
});

/* Bootstrap tooltip for reject offer */
$(document).on('mouseover', '#reject-offer', function() {
	$(this).tooltip({
		placement: 'bottom',
		title: 'Reject offer permanently',
		container: 'body'
	}).tooltip('show');
});

/* Bootstrap tooltip for counter-offer */
$(document).on('mouseover', '#counter-offer', function() {
	$(this).tooltip({
		placement: 'bottom',
		title: 'Place counter-offer',
		container: 'body'
	}).tooltip('show');
});