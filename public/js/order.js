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

		var default_location = true;

		/* Google maps */
		$('input[name=shipping-address]').geocomplete({
			map: '#map-canvas',
			location: 'Wroclaw'
		})
		.bind("geocode:result", function(event, result){
			address = $('input[name=shipping-address]').val();

			if (!default_location) {
				$.get('/order/delivery_date/' + address, function(data) {
					$('#delivery-date').html(data['date']);
				});
			}

			default_location = false;
		});
		$("#find").click(function(){
			$("input[name=shipping-address]").trigger("geocode");
		});

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