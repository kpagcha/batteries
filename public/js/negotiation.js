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
	var parent = $(this).parent();
	if (parent.find('div#show').length) {
		parent.find('div#show').slideUp('200',function() {
			parent.find('div#show').remove();
		});
	} else {
		$.get('/negotiation/negotiate', $(this).find('form').serialize(), function(data) {
			parent.append(data['view']);
			parent.find('div#show').hide().slideDown('400');
		});
	}
});