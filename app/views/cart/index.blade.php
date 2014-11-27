<div class="panel panel-default">
	<div class="panel-heading text-center"><h4>Shopping cart</h4></div>
	<div class="panel-body text-center">
		<p>This is your shopping cart.</p>
		@if (count($cart_batteries) == 0)
			<hr>
			<p class="alert alert-info text-center">There are no items in your cart.</p>
		@endif
	</div>
	@if (count($cart_batteries))
	<ul class="list-group">
		@foreach ($cart_batteries as $item)
			<?php $battery = $item['battery']; $amount = $item['amount']; ?>
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-1 col-sm-1 col-xs-2">
						<div class="btn-group-vertical">
							<button id="increase" type="button" class="btn btn-default modify-cart-amount">
								<span class="glyphicon glyphicon-chevron-up"></span>
								{{ Form::open() }}
									{{ Form::hidden('amount', 1) }}
									{{ Form::hidden('battery-id', $battery->id) }}
								{{ Form::close() }}
							</button>
							<button id="decrease" type="button" class="btn btn-default modify-cart-amount">
								<span class="glyphicon glyphicon-chevron-down"></span>
								{{ Form::open() }}
									{{ Form::hidden('amount', -1) }}
									{{ Form::hidden('battery-id', $battery->id) }}
								{{ Form::close() }}
							</button>
						</div>
					</div>
					<div class="col-md-11 col-sm-11 col-xs-10 top-void">
						{{ Form::open() }}
							{{ Form::hidden('battery-id', $battery->id) }}
						{{ Form::close() }}
						<span name="amount">
							({{ $amount }})
						</span>
						<a name="show-battery" href="/battery/{{ $battery->id }}">
							{{ $battery->name }} ({{ $battery->category }}), {{ $battery->voltage }} volts
							@if ($battery->technology != "")
								&#8212; {{ $battery->technology }}
							@endif
						</a>
						<span class="pull-right" name="delete-cart-item" data-toggle="tooltip" data-placement="right" title="Delete from cart"><a href="#"><span class="glyphicon glyphicon-remove delete"></span></a></span>
					</div>
				</div>
			</li>
		@endforeach
	</ul>
	<div class="panel-footer text-center">
		<span data-toggle="tooltip" data-placement="bottom" title="Start negotiation"><a href="#" id="order"><img src="/images/sprites/order.png"></a><span>
	</div>
	@endif
</diV