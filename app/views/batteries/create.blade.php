<div style="padding:2em">
	<div id="success" class="alert alert-success hidden"></div>
	<div class="col-md-6 col-md-offset-5">
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#add-new-battery">Add new battery</button>
	</div>
	<div class="modal fade" id="add-new-battery" tabindex="-1" role="dialog" aria-labelledby="add-new-battery-label" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        <h4 class="modal-title" id="add-new-battery-label">New battery</h4>
	        <ul id="errors" class="alert alert-warning list-unstyled hidden"></ul>
	      </div>
	      <div class="modal-body">
	      	@include('batteries.form')
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button id="create-battery" type="button" class="btn btn-primary">Save</button>
	      </div>
	    </div>
	  </div>
	</div>
</div>