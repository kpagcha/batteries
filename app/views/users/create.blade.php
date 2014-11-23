<div style="padding:2em">	
	<div class="modal fade" id="create-new-user" tabindex="-1" role="dialog" aria-labelledby="create-new-user-label" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	        	<h4 class="modal-title" id="create-new-user-label">Create user</h4>
	        	<ul id="errors" class="alert alert-warning list-unstyled hidden"></ul>
	      	</div>
	      	<div class="modal-body">
	      		@include('users.form')
	      	</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        	<button id="create-user" type="button" class="btn btn-primary">Save</button>
	      	</div>
	    </div>
	  </div>
	</div>
</div>