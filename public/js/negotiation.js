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
	var parent = $(this).parent().parent();
	if (parent.find('div#show-negotiation').length) {
		parent.find('div#show-negotiation').slideUp('200',function() {
			parent.find('div#show-negotiation').remove();
		});
	} else {
		$.get('/negotiation/negotiation_form', $(this).find('form').serialize(), function(data) {
			if (data['status']) {
				parent.append(data['view']);
				parent.find('div#show-negotiation').hide().slideDown('400');
			}
		});
	}
});

/* Load counter-offer form */
$(document).on('click', '#counter-offer', function(e) {
	e.preventDefault();
	var thiz = $(this);
	var element = thiz.closest('#negotiation-buttons').find('div#counter-offer-form-container')
	$.get('/negotiation/counter_offer', $(this).find('form').serialize(), function(data) {
		if (data['status']) {
			if (element.length) {
				element.slideUp('200', function() {
					element.remove();
				});
			}  else {
				thiz.closest('#negotiation-buttons').append(data['form']).
				find('#counter-offer-form-container').hide().slideDown(400);
			}
		}
	});
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

/* Send counter offer form */
$(document).on('submit', '#counter-offer-form', function(event) {
	event.preventDefault();
	var container = $(this).closest('#show-negotiation');
	$.post('/negotiation/counter_offer', $('#counter-offer-form').serialize(), function(data) {
		if (data['status']) {
			if (data['invalid_price']) {
				$('input[name=price]').parent().addClass('has-error');
			} else {
				container.slideUp(200).delay(200, function() {
					container.remove();
					$('#notice').removeClass('hidden').html('Price proposal has been sent.');
				});
			}
		}
	});
});

/* Accept proposed price */
$(document).on('click', '#accept-offer', function(event) {
	event.preventDefault();
	var container = $(this).closest('#show-negotiation');
	var li = container.closest('li');
	$.post('/negotiation/complete', $(this).find('form').serialize(), function(data) {
		container.slideUp(200).delay(200, function() {
			if (data['has_active_negotiations']) {
				container.closest('ul').next('div').find('a').removeClass('disabled');
			}
			container.remove();
			$('.tooltip').addClass('hidden');
			li.removeClass('list-group-item-primary').addClass('list-group-item-success');
			li.find('.pull-right').html('<small>completed</small>');
			li.find('#display-negotiation').addClass('disabled');
		});
	});
});

/* Reject proposed price and stop negotiation */
$(document).on('click', '#reject-offer', function(event) {
	event.preventDefault();
	var container = $(this).closest('#show-negotiation');
	var li = container.closest('li');
	$.post('/negotiation/reject', $(this).find('form').serialize(), function(data) {
		container.slideUp(200).delay(200, function() {
			container.remove();
			$('#notice').removeClass('hidden').html('The negotiation process was canceled.');
			$('.tooltip').addClass('hidden');
			li.wrapInner('<div style="display: block;" />').find('div').slideUp(200).delay(200, function() {
				li.remove();
			})
		});
	});
});