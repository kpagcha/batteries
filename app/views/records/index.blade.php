<div class="panel panel-default">
	<div class="panel-heading text-center"><h4>History of negotiations</h4></div>
	<div class="panel-body text-center">
		<p>Here you can find the records for all negotiations.</p>
		@if (count($records) == 0)
			<hr>
			<p class="alert alert-info text-center">No records were found.</p>
		@endif
	</div>
	<ul class="list-group">
		@foreach ($records as $record)
			<?php $status = $record->status->name; $status_class = "";
				switch ($status) {
					case 'open': $status = 'waiting for vendor'; $status_class = 'list-group-item-info'; break;
					case 'in_process': $status = 'in process'; $status_class = 'list-group-item-primary'; $disabled = ""; break;
					case 'completed': $status_class = 'list-group-item-success'; break;
					case 'rejected': $status_class = 'list-group-item-danger'; break;
				}
			?>
			<li class="list-group-item {{ $status_class }}">
				<div class="row">
					<div class="col-md-12 top-void">
						{{ Form::open() }}
							{{ Form::hidden('battery-id', $record->battery->id) }}
						{{ Form::close() }}
						<div class="col-md-10 col-sm-10 col-xs-10">
							<span>
								{{ $record->price }} €
							</span>
							<span name="amount">
								({{ $record->amount }})
							</span>
							<a name="battery" href="/battery/{{ $record->battery->id }}">
								<?php $battery = $record->battery ?>
								{{ $battery->name }} ({{ $battery->category }}), {{ $battery->voltage }} volts
								@if ($battery->technology != "")
									&#8212; {{ $battery->technology }}
								@endif
							</a>
						</div>
						<div class="col-md-2 col-sm-2 col-xs-2">
							<div class="pull-right"><small>{{ $status }}</small></div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<strong>Customer: </strong><span>{{ $record->customer->email }}</span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<strong>Manager: </strong><span>{{ $record->manager ? $record->manager->email : 'none' }}</span>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<strong>Date: </strong>{{ $record->created_at }}
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<strong>Order #{{ $record->order_id }} </strong>
						</div>
					</div>
				</div>
			</li>
		@endforeach
	</ul>
	<div id="history-links" class="panel-footer text-center">
		{{ $records->links() }}
	</div>
</div>