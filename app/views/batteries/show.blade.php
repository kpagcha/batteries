<div id="show-battery" class="row">
	<hr>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-3">
			<strong>Name</strong>
		</div>
		<div class="col-md-9 col-xs-9">
			{{ $battery->name }}
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-3">
			<strong>Category</strong>
		</div>
		<div class="col-md-9 col-xs-9">
			{{ $battery->category }}
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-3">
			<strong>Technology</strong>
		</div>
		<div class="col-md-9 col-xs-9">
			@if ($battery->technology)
				{{ $battery->technology }}
			@else
				-
			@endif
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-3">
			<strong>Voltage</strong>
		</div>
		<div class="col-md-9 col-xs-9">
			@if ($battery->voltage)
				{{ $battery->voltage }} V
			@else
				-
			@endif
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-3">
			<strong>Capacity</strong>
		</div>
		<div class="col-md-9 col-xs-9">
			@if ($battery->capacity)
				{{ $battery->capacity }} mAh
			@else
				-
			@endif
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-3">
			<strong>Height</strong>
		</div>
		<div class="col-md-9 col-xs-9">
			@if ($battery->height)
				{{ $battery->height }} mm
			@else
				-
			@endif
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-3">
			<strong>Diameter</strong>
		</div>
		<div class="col-md-9 col-xs-9">
			@if ($battery->diameter)
				{{ $battery->diameter }} mm
			@else
				-
			@endif
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-3">
			<strong>Starting price</strong>
		</div>
		<div class="col-md-9 col-xs-9">
			@if ($battery->price)
				{{ $battery->price }} €
			@else
				-
			@endif
		</div>
	</div>
</div>