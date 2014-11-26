<?php $battery = $item['battery']; $amount = $item['amount'];
	$status = Status::find(Negotiation::find($item['negotiation_id'])->status_id)->name; $status_class = "";
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