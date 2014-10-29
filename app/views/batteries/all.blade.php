@if(isset($batteries))
	<table class="table table-striped table-responsive">
		<thead>
			<tr>
				<th>Nombre</th>
				<th>Habitantes</th>
				<th>País</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($batteries as $battery)
				<tr>
				</tr>
			@endforeach
			</tr>
		</tbody>
	</table>
	{{ $batteries->links() }}
@endif
<h1>wat</h1>