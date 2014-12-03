/* "Working" functions or those with bussiness logic */

/* --------------------------------------------------------------------------------------------------------------------/*

/* "Assign to view" or "respond to click" functions */

/* Create order and start negotiation */
$(document).on('click', '#order', function(event) {
	event.preventDefault();
	$.get('/order/create', function(data) {
		$.get('/cart', function(data) {
			$('.tab-pane').removeClass('active');
			$('#main-tabs li').removeClass('active');
			$('#shopping-cart-tab').addClass('active');
			$('#shopping-cart').addClass('active');
			$('#shopping-cart').html(data['view']);
			$('p.alert').html('Your cart was emptied. Go to the negotiation section to start negotiating the price of your selected products.');
		});
	});
});

/* Start checkout process */
$(document).on('click', '#start-checkout', function(event) {
	$.get('/order/checkout_form', $(this).find('form').serialize(), function(data) {
		$('#negotiations').html(data['view']);
		$('#notice').addClass('hidden');

		var default_location = true;

		/* Google maps */
		$('#geocomplete').geocomplete({
			map: '#map-canvas',
			location: 'Wroclaw'
		})
		.bind("geocode:result", function(event, result){
			address = result.formatted_address;

			if (!default_location) {
				$.get('/order/delivery_date/' + address, function(data) {
					if (!data['error']) {
						$('#delivery-date').html(data['date']);
						$('#address-error').addClass('hidden');
					} else {
						$('#address-error').removeClass('hidden').html(data['error']);
						$('#delivery-date').html('?');
						$('#finish-checkout input[name=shipping-address]').val('');
					}
				});
			} else {
				$('#finish-checkout input[name=shipping-address]').val('');
				default_location = false;
			}
		});
		$("#find").click(function() {
			$("#geocomplete").trigger("geocode");
		});
	});
});

/* Complete order */
$(document).on('click', '#finish-checkout', function(event) {
	event.preventDefault();
	$(this).find('form').find('input[name=delivery-date]').val($('#delivery-date').html());
	$(this).find('form').find('input[name=shipping-address]').val($('#shipping-address').val());
	$.get('/order/complete', $(this).find('form').serialize(), function(data) {
		if (data['error']) {
	        $("html, body").animate({ scrollTop: 0 }, "fast");
			$('input[name=shipping-address]').parent().parent().addClass('has-warning');
		} else {
			$('.tooltip').hide();
			$('#negotiations').html(data['view']);
		}
	});
});

/* Delete order */
$(document).on('click', '#delete-order', function(event) {
	event.preventDefault();
	var id = $(this).find('input[name=order-id]').val();
	$.ajax({
		url: '/order/' + id,
		type: 'delete',
		data: $(this).find('form').serialize(),
		context: this
	})
	.done(function(data) {
		$('.tooltip').hide();
		$('#negotiations').html(data['view']);
	});
});

/* Bootstrap tooltip for finish checkout and delete order */
$(document).on('mouseover', '#finish-checkout, #delete-order', function() {
	$(this).tooltip({
		placement: 'top',
		container: 'body'
	}).tooltip('show');
});

/* Show battery */
$(document).on('click', 'a[name=show-order-battery]', function(event) {
	event.preventDefault();
	var id = $(this).parent().find("input[name='battery-id']").val();
	var parent = $(this).parent();
	if (parent.find('div#show').length) {
		parent.find('div#show').slideUp('200',function() {
			parent.find('div#show').remove();
		});
	} else {
		$.get('/order/battery/' + id, function(data) {
			parent.append(data['view']);
			parent.find('div#show').hide().slideDown('400');
		});
	}
});