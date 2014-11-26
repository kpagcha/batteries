<div class="panel panel-default">
	<div class="panel-heading text-center"><h4>Negotiations</h4></div>
	<div class="panel-body">
		<p>This is your negotiations panel.</p>
		<div class="text-center order-title">
			<strong>Your current negotiations</strong>
		</div>
		@if (count($active_orders) == 0)
			<div id="active-orders-info">
				<hr>
				<p class="alert alert-info text-center">You are not supervising any negotiation.</p>	
			</div>
		@endif
	</div>
	<div id="list-body">
		@include('negotiations.active_negotiations_list')
	</div>
	<div class="panel-body">
		<div class="text-center order-title" id="negotiations-waiting-title">
			<strong>Negotiations waiting</strong>
		</div>
		@if (count($unattended_orders) == 0)
			<hr>
			<p class="alert alert-info text-center">There are no negotiations pending currently.</p>
		@endif
	</div>
	@if (count($unattended_orders))
		@foreach ($unattended_orders as $key => $order)
			<ul class="list-group">
				@foreach ($order as $item)
					<?php $battery = $item['battery']; $amount = $item['amount']; ?>

					<li class="list-group-item list-group-item-info">
						<div class="row">
							<div class="col-md-11 col-sm-11 col-xs-10 top-void">
								{{ Form::open() }}
									{{ Form::hidden('battery-id', $battery->id) }}
								{{ Form::close() }}

								<a id="take-negotiation" href="#negotiate" class="btn btn-default no-borders-button" data-toggle="tooltip" data-placement="left" title="Take this negotiation">
									<img src="images/sprites/money.png"/>
									{{ Form::open() }}
										{{ Form::hidden('negotiation-id', $item['negotiation_id']) }}
									{{ Form::close() }}
								</a>
								<span name="amount">
									({{ $amount }})
								</span>
								<a name="show-battery" href="/battery/{{ $battery->id }}">
									{{ $battery->name }} ({{ $battery->category }}), {{ $battery->voltage }} volts
									@if ($battery->technology != "")
										&#8212; {{ $battery->technology }}
									@endif
								</a>
							</div>
						</div>
					</li>
				@endforeach
			</ul>
		@endforeach
	@endif
</diV