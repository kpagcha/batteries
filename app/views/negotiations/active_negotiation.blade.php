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
		<div class="col-md-11 col-sm-11 col-xs-10 top-void">
			{{ Form::open() }}
				{{ Form::hidden('battery-id', $battery->id) }}
			{{ Form::close() }}

			<a href="#display-negotiation" id="display-negotiation" class="btn btn-default no-borders-button">
				<img src="images/sprites/money.png">
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
			<div class="pull-right"><small>{{ $status }}</small></div>
		</div>
	</div>
</li>