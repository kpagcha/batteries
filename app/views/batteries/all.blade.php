{{ Form::open(['id' => 'create-battery-form']) }}
	@include('batteries.create')
{{ Form::close() }}


<div id="manage-batteries-container" class="col-md-12 col-xs-12 container-fluid container-default">
	<div style="padding:2em">
		<div id="success" class="col-md-4 col-md-offset-4 col-xs-12 text-center alert alert-success hidden"></div>
		<div class="col-md-6 col-md-offset-5 col-xs-6 col-xs-offset-4">
			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-new-battery">Add new battery</button>
		</div>	
	</div>
	<div class="col-md-12 col-xs-12 table-responsive" id="batteries-list">
		<table class="table" style="margin-top:4em">
			<thead>
				<tr>
					<th>Price</th>
					<th>Name</th>
					<th>Category</th>
					<th>Technology</th>
					<th>Voltage</th>
					<th>Capacity</th>
					<th>Height</th>
					<th>Diameter</th>
					<th colspan="2"></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($batteries as $battery)
					<tr>
						<td>{{ $battery->price }} €</td>
						<td>{{ $battery->name }}</td>
						<td>{{ $battery->category }}</td>
						<td>
							@if($battery->technology)
								{{ $battery->technology }}
							@else
								-
							@endif
						</td>
						<td>
							@if($battery->voltage)
								{{ $battery->voltage }} V
							@else
								-
							@endif
						</td>
						<td>
							@if($battery->capacity)
								{{ $battery->capacity }} mAh
							@else
								-
							@endif
							</td>
						<td>
							@if($battery->height)
								{{ $battery->height }} mm
							@else
								-
							@endif
						</td>
						<td>
							@if($battery->diameter)
								{{ $battery->diameter }} mm
							@else
								-
							@endif
						</td>
						<td>
							{{ Form::open(['class' => 'pull-right']) }}
								<span class="glyphicon glyphicon-pencil btn btn-xs btn-success"></span>
								{{ Form::hidden('edit-id', $battery->id) }}
							{{ Form::close() }}
						</td>
						<td>
							{{ Form::open(['class' => 'pull-right']) }}
								<span class="glyphicon glyphicon-remove btn btn-xs btn-danger"></span>
								{{ Form::hidden('id', $battery->id) }}
							{{ Form::close() }}
						</td>
					</tr>
				@endforeach
				</tr>
			</tbody>
		</table>
		{{ $batteries->links() }}
	</div>
</div>