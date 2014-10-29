@if(isset($batteries))
	<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th>Name</th>
				<th>Category</th>
				<th>Technology</th>
				<th>Voltage</th>
				<th>Capacity</th>
				<th>Height</th>
				<th>Diameter</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($batteries as $battery)
				<tr>
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
				</tr>
			@endforeach
			</tr>
		</tbody>
	</table>
	{{ $batteries->links() }}
@endif