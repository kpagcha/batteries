/* "Working" functions or those with bussiness logic */

function renderCart() {
	$.get('/cart', function(data) {
		$('.tab-pane').removeClass('active');
		$('#main-tabs li').removeClass('active');
		$('#shopping-cart-tab').addClass('active');
		$('#shopping-cart').addClass('active');
		$('#shopping-cart').html(data['view']);
	});
}

/* --------------------------------------------------------------------------------------------------------------------/*

/* "Assign to view" or "respond to click" functions */

/* Add item to cart */
$(document).on('click', 'a[name=add-to-cart]', function(event) {
	event.preventDefault();
	var thiz = $(this);
	$.post('/cart', $(thiz.parent().parent().find('form')).serialize(), function(data) {
		$('#notice').removeClass('hidden');
		$('#notice').html(data['message']);
	});
});

/* Change to cart tab */
$(document).on('click', '#shopping-cart-tab a', function(event) {
	event.preventDefault();
	renderCart();
});

/* Modify cart item amount */
$(document).on('click', '#increase, #decrease', function() {
	var amount_element = $(this).parent().parent().next('div').find('span[name=amount]');
	var battery_id = $(this).parent().parent().next('div').find('input[name=battery-id]').attr('value');
	var amount = $(this).find('input[name=amount]').attr('value');
	$.post('/cart/changeAmount', $(this).find('form').serialize(), function(data) {
		amount_element.html('(' + data['amount'] + ')');
	});
});

/* Delete cart item */
$(document).on('click', 'span[name=delete-cart-item]', function(event) {
	event.preventDefault();
	var thiz = $(this);
	var id = thiz.parent().find('input[name=battery-id]').val();

	$.ajax({
		url: '/cart/' + id,
		type: 'DELETE'
	})
	.done(function(data) {
		var executed = false;
		var count = data['count'];
		thiz.parent()
			.parent()
			.parent()
			.parent()
			.wrapInner('<div style="display: block;" />')
			.parent()
			.find('li > div')
			.slideUp(200)
			.delay(200, function() {
				if (!executed) {
					thiz.closest('li').remove();
					$.get('/cart', function(data) {
						$('.tab-pane').removeClass('active');
						$('#main-tabs li').removeClass('active');
						$('#shopping-cart-tab').addClass('active');
						$('#shopping-cart').addClass('active');
						if (count) {
							$('#shopping-cart').html(data['view']).find('.list-group').hide().slideDown('slow');
						} else {
							$('#shopping-cart').html(data['view']).find('.panel-body').hide().slideDown('slow');
						}
					});
					executed = true;
				}
			});
	});
});