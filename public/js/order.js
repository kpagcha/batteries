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