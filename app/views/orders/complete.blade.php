<div class="panel panel-default">
	<div class="panel-heading text-center"><h4>Check-out</h4></div>
	<div class="panel-body text-center succeed">
		Your order has been processed successfully. You will receive your delivery in {{ $order->delivery_address }} on this date aproximately {{ $order->delivery_date }}.
	</div>
	<div class="col-md-12 text-center">
		<strong>Order overview</strong>
	</div>
	<ul id="order-summary-list" class="list-group">
		<br>
		<?php $total = 0; ?>
		@foreach ($order->completedNegotiations() as $negotiation)
			<li class="list-group-item">
				<div class="row">
					<div class="col-md-11 col-sm-11 col-xs-10 top-void">
						{{ Form::open() }}
							{{ Form::hidden('battery-id', $negotiation->battery->id) }}
						{{ Form::close() }}
						<span name="amount">
							({{ $negotiation->amount }})
						</span>
						<a name="show-order-battery" href="/battery/{{ $negotiation->battery->id }}">
							{{ $negotiation->battery->name }} ({{ $negotiation->battery->category }}), {{ $negotiation->battery->voltage }} volts
							@if ($negotiation->battery->technology != "")
								&#8212; {{ $negotiation->battery->technology }}
							@endif
						</a>
						<span class="pull-right">
							{{ $negotiation->price * $negotiation->amount }} € <small>({{ $negotiation->price }}/u.)</small>
						</span>
						<?php $total += $negotiation->price * $negotiation->amount; ?>
					</div>
				</div>
			</li>
		@endforeach
		<li class="list-group-item text-center"><strong>Total {{ $total }} €</strong></li>
	</ul>
</div>