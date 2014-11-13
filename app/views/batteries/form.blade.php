<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('name', 'Name', ['class' => 'control-label']) }}
			{{ Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Name of the battery', 'id' => 'input-name']) }}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('category', 'Category', ['class' => 'control-label']) }}
			{{ Form::text('category', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'N, AA, AAA, C, D...', 'id' => 'input-category']) }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('technology', 'Technology', ['class' => 'control-label']) }}
			{{ Form::text('technology', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Alkaline, aluminium, dry cell, lithium air...', 'id' => 'input-technology']) }}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('voltage', 'Voltage', ['class' => 'control-label']) }}
			{{ Form::text('voltage', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Unit: volts', 'id' => 'input-voltage']) }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('capacity', 'Capacity', ['class' => 'control-label']) }}
			{{ Form::text('capacity', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Unit: mAh', 'id' => 'input-capacity']) }}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('height', 'Height', ['class' => 'control-label']) }}
			{{ Form::text('height', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Height of the battery in mm', 'id' => 'input-height']) }}
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('diameter', 'Diameter', ['class' => 'control-label']) }}
			{{ Form::text('diameter', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Diameter of the battery in mm', 'id' => 'input-diameter']) }}
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			{{ Form::label('price', 'Price', ['class' => 'control-label']) }}
			{{ Form::text('price', null, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Price in €', 'id' => 'input-price']) }}
		</div>
	</div>
</div>