<div id="show">
	<hr>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-12">
			<strong>Name</strong>
		</div>
		<div class="col-md-9 col-xs-12">
			{{ $battery->name }}
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-12">
			<strong>Category</strong>
		</div>
		<div class="col-md-9 col-xs-12">
			{{ $battery->category }}
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-12">
			<strong>Technology</strong>
		</div>
		<div class="col-md-9 col-xs-12">
			@if ($battery->technology)
				{{ $battery->technology }}
			@else
				-
			@endif
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-12">
			<strong>Voltage</strong>
		</div>
		<div class="col-md-9 col-xs-12">
			@if ($battery->voltage)
				{{ $battery->voltage }} V
			@else
				-
			@endif
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-12">
			<strong>Capacity</strong>
		</div>
		<div class="col-md-9 col-xs-12">
			@if ($battery->capacity)
				{{ $battery->capacity }} mAh
			@else
				-
			@endif
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-12">
			<strong>Height</strong>
		</div>
		<div class="col-md-9 col-xs-12">
			@if ($battery->height)
				{{ $battery->height }} mm
			@else
				-
			@endif
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-12">
			<strong>Diameter</strong>
		</div>
		<div class="col-md-9 col-xs-12">
			@if ($battery->diameter)
				{{ $battery->diameter }} mm
			@else
				-
			@endif
		</div>
	</div>
	<div class="col-md-12 col-xs-12">
		<div class="col-md-3 col-xs-12">
			<strong>Starting price</strong>
		</div>
		<div class="col-md-9 col-xs-12">
			@if ($battery->price)
				{{ $battery->price }} €
			@else
				-
			@endif
		</div>
	</div>
</div>