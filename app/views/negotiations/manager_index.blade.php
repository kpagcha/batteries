<div class="panel panel-default">
	<div class="panel-heading text-center"><h4>Negotiations</h4></div>
	<div class="panel-body">
		<p>This is your negotiations panel.</p>
		<div class="text-center order-title">
			<strong>Your current negotiations</strong>
		</div>
		@if (count($active_orders) == 0)
			<hr>
			<p class="alert alert-info text-center">You are not supervising any negotiation.</p>
		@endif
	</div>
	@if (count($active_orders))
		@foreach ($active_orders as $key => $order)
			<ul class="list-group">
				@foreach ($order as $item)
					<?php $battery = $item['battery']; $amount = $item['amount'];
					$status = Negotiation::find($item['negotiation_id'])->status[0]->name; $status_class = "";
					switch ($status) {
						case 'open': $status = 'waiting for vendor'; $status_class = 'list-group-item-info'; break;
						case 'in_process': $status = 'in process'; $status_class = 'list-group-item-primary'; break;
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

								<a href="#negotiate" class="btn btn-default disabled no-borders-button"><img src="images/sprites/money.png"></a>
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
		@endforeach
	@endif
	<div class="panel-body">
		<div class="text-center order-title">
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

								<a href="#negotiate" class="btn btn-default no-borders-button" data-toggle="tooltip" data-placement="left" title="Take this negotiation">
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