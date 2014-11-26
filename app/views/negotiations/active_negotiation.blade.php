<?php $battery = $item['battery']; $amount = $item['amount'];
	$status = Status::find(Negotiation::find($item['negotiation_id'])->status_id)->name; $status_class = "";
	switch ($status) {
		case 'in_process': $status = 'in process'; $status_class = 'list-group-item-primary'; break;
		case 'completed': $status_class = 'list-group-item-success'; break;
		case 'rejected': $status_class = 'list-group-item-danger'; break;
	}
?>
<li class="list-group-item {{ $status_class }}">
	<div class="row">
		<div class="col-md-12 top-void">
			{{ Form::open() }}
				{{ Form::hidden('battery-id', $battery->id) }}
			{{ Form::close() }}

			<div class="col-md-2 col-sm-2 col-xs-2">
				<a href="#display-negotiation" id="display-negotiation" class="btn btn-default no-borders-button" data-toggle="tooltip" data-placement="left" title="Continue with this negotiation">
					<img src="images/sprites/money.png">
					{{ Form::open() }}
						{{ Form::hidden('negotiation-id', $item['negotiation_id']) }}
					{{ Form::close() }}
				</a>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-8">
				<span name="amount">
					({{ $amount }})
				</span>
				<a name="battery" href="/battery/{{ $battery->id }}">
					{{ $battery->name }} ({{ $battery->category }}), {{ $battery->voltage }} volts
					@if ($battery->technology != "")
						&#8212; {{ $battery->technology }}
					@endif
				</a>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-2">
				<div class="pull-right"><small>{{ $status }}</small></div>
			</div>
		</div>
	</div>
</li>