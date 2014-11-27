<div class="panel panel-default">
	<div class="panel-heading text-center"><h4>Check-out</h4></div>
	<div class="panel-body text-center">
		Proceed with the checkout for your order.<br>
		<span style="color:#82726A"><small>Order reference code {{ $order->id }}</small></span>
	</div>
		<hr>
	<div class="row">
		<div class="col-md-12">
			{{ Form::open(['class' => 'form-horizontal']) }}
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-4 col-sm-4 col-xs-12">
							{{ Form::label('shipping-address', 'Shipping address', ['class' => 'control-label']) }}
						</div>
						<div class="col-md-8 col-sm-8 col-xs-8">
							<div class="input-group">
								{{ Form::text('shipping-address', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Where do you want your order to be delivered?']) }}
								<span id="find" class="input-group-addon"><span class="glyphicon glyphicon-ok succeed"></span></span>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-12 col-sm-12 col-xs-12 extra-padding">
					<div id="map-canvas" style="width:100%;height:450px"></div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<label class="control-label">Delivery date</label>
						</div>
						<div class="col-md-8 col-sm-8 col-xs-8">
							<p id="delivery-date" class="form-control-static">?</p>
						</div>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
	<div class="panel-footer text-center">
		<a id="finish-checkout" href="#finish-checkout" class="btn btn-default no-borders-button"><img src="images/sprites/checkout.png">
			{{ Form::open() }}
				{{ Form::hidden('order-id', $order->id) }}
			{{ Form::close() }}
		</a>
		<a id="cancel-checkout" href="#canel-checkout" class="btn btn-default no-borders-button pull-right"><img src="images/sprites/cancel.png">
			{{ Form::open() }}
				{{ Form::hidden('order-id', $order->id) }}
			{{ Form::close() }}
		</a>
	</div>
</div>