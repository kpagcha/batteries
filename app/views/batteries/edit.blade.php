<div class="modal fade" id="edit-errors" tabindex="-1" aria-labelledby="" aria-hidden="true">
	<div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title">Errors were found in the form</h4>
    		</div>
	    	<div class="modal-body">
	    		<ul class="list-unstyled"></ul>
	    	</div>
	    </div>
	</div>
</div>
<td colspan="8">
	<div class="row" id="edit-form-container">
		{{ Form::open(['id' => 'edit-battery-form']) }}
		<div class="form-group col-md-6">
			<div class="col-md-3">
				{{ Form::label('name', 'Name', ['class' => 'control-label']) }}
			</div>
			<div class="col-md-9">
				{{ Form::text('name', $battery->name, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Name of the battery', 'id' => 'input-name']) }}
			</div>
		</div>
		<div class="form-group col-md-6">
			<div class="col-md-3">
				{{ Form::label('category', 'Category', ['class' => 'control-label']) }}
			</div>
			<div class="col-md-9">
				{{ Form::text('category', $battery->category, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'N, AA, AAA, C, D...', 'id' => 'input-category']) }}
			</div>
		</div>
		<div class="form-group col-md-6">
			<div class="col-md-3">
				{{ Form::label('technology', 'Technology', ['class' => 'control-label']) }}
			</div>
			<div class="col-md-9">
				{{ Form::text('technology', $battery->technology, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Alkaline, aluminium, dry cell, lithium air...', 'id' => 'input-technology']) }}
			</div>
		</div>
		<div class="form-group col-md-6">
			<div class="col-md-3">
				{{ Form::label('voltage', 'Voltage', ['class' => 'control-label']) }}
			</div>
			<div class="col-md-9">
				{{ Form::text('voltage', $battery->voltage, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Unit: volts', 'id' => 'input-voltage']) }}
			</div>
		</div>
		<div class="form-group col-md-6">
			<div class="col-md-3">
				{{ Form::label('capacity', 'Capacity', ['class' => 'control-label']) }}
			</div>
			<div class="col-md-9">
				{{ Form::text('capacity', $battery->capacity, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Unit: mAh', 'id' => 'input-capacity']) }}
			</div>
		</div>
		<div class="form-group col-md-6">
			<div class="col-md-3">
				{{ Form::label('height', 'Height', ['class' => 'control-label']) }}
			</div>
			<div class="col-md-9">
				{{ Form::text('height', $battery->height, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Height of the battery in mm', 'id' => 'input-height']) }}
			</div>
		</div>
		<div class="form-group col-md-6">
			<div class="col-md-3">
				{{ Form::label('diameter', 'Diameter', ['class' => 'control-label']) }}
			</div>
			<div class="col-md-9">
				{{ Form::text('diameter', $battery->diameter, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Diameter of the battery in mm', 'id' => 'input-diameter']) }}
			</div>
		</div>
		<div class="form-group col-md-6">
			<div class="col-md-3">
				{{ Form::label('price', 'Price', ['class' => 'control-label']) }}
			</div>
			<div class="col-md-9">
				{{ Form::text('price', $battery->price, ['class' => 'form-control', 'autocomplete' => 'off', 'placeholder' => 'Price in €', 'id' => 'input-price']) }}
			</div>
		</div>
		<div class="form-group col-md-6 col-md-offset-6">
			<span class="glyphicon glyphicon-floppy-disk btn btn-success"></span>
			<span class="glyphicon glyphicon-ban-circle btn btn-primary"></span>
			{{ Form::hidden('update-id', $battery->id) }}
		</div>
		{{ Form::close() }}
	</div>
</td>