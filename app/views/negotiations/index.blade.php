<div class="panel panel-default">
	<div class="panel-heading text-center"><h4>Negotiations</h4></div>
	<div class="panel-body">
		<p>This is your negotiations panel.</p>
		@if (count($orders) == 0)
			<hr>
			<p class="alert alert-info text-center">Currently you have no active negotiations.</p>
		@endif
	</div>
	@if (count($orders))
		@foreach ($orders as $key => $order)
			<div class="text-center order-title">
				<strong>Order #{{ $order[$key]['order_id'] }}</strong> <small>[{{ $order[$key]['status']['name'] }}]</small>
			</div>
			<ul class="list-group">
				@foreach ($order as $item)
					<?php $battery = $item['battery']; $amount = $item['amount'];
					$status = Status::find(Negotiation::find($item['negotiation_id'])->status_id)->name; $status_class = ""; $disabled = "disabled";
					switch ($status) {
						case 'open': $status = 'waiting for vendor'; $status_class = 'list-group-item-info'; break;
						case 'in_process': $status = 'in process'; $status_class = 'list-group-item-primary'; $disabled = ""; break;
						case 'completed': $status_class = 'list-group-item-success'; break;
						case 'rejected': $status_class = 'list-group-item-danger'; break;
					}
					?>

					<li class="list-group-item {{ $status_class }}">
						<div class="row">
							<div class="col-md-11 col-sm-11 col-xs-10 top-void">
								{{ Form::open() }}
									{{ Form::hidden('battery-id', $battery->id) }}
								{{ Form::close() }}

								<a href="#negotiate" class="btn btn-default {{ $disabled }}} no-borders-button"><img src="images/sprites/money.png"></a>
								<span name="amount">
									({{ $amount }})
								</span>
								<a name="show-battery" href="/battery/{{ $battery->id }}">
									{{ $battery->name }} ({{ $battery->category }}), {{ $battery->voltage }} volts
									@if ($battery->technology != "")
										&#8212; {{ $battery->technology }}
									@endif
								</a>
								<div class="pull-right"><small>{{ $status }}</small></div>
							</div>
						</div>
					</li>
				@endforeach
			</ul>
			<div class="panel-footer text-center">
				<a href="#checkout" class="btn btn-default disabled no-borders-button"><img src="images/sprites/checkout.png"></a>
			</div>
		@endforeach
	@endif
</diV