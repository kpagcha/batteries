{{ Form::open(['id' => 'create-battery-form']) }}
	@include('batteries.create')
{{ Form::close() }}

<div class="col-md-12" id="batteries-list">
	<table class="table table-responsive" style="margin-top:4em">
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