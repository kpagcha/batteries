{{ Form::open(['id' => 'create-user-form']) }}
	@include('users.create')
{{ Form::close() }}


<div id="manage-users-container" class="col-md-12 col-xs-12 container-fluid container-default">
	<div style="padding:2em">
		<div id="success" class="col-md-4 col-md-offset-4 col-xs-12 text-center alert alert-success hidden"></div>
		<div class="col-md-6 col-md-offset-5 col-xs-6 col-xs-offset-2">
			<button type="button" class="btn btn-default" data-toggle="modal" data-target="#create-new-user">Create new user</button>
		</div>	
	</div>
	<div class="col-md-12 col-xs-12 table-responsive" id="users-list">
		<table class="table" style="margin-top:4em">
			<thead>
				<tr>
					<th>Email</th>
					<th>First name</th>
					<th>Last name</th>
					<th>City</th>
					<th>Country</th>
					<th>Phone</th>
					<th>Role</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user)
					<tr>
						<td>{{ $user->email }}</td>
						<td>{{ $user->first_name }}</td>
						<td>{{ $user->last_name }}</td>
						<td>
							@if($user->city)
								{{ $user->city }}
							@else
								-
							@endif
						</td>
						<td>
							@if($user->country)
								{{ $user->country }}
							@else
								-
							@endif
						</td>
						<td>
							@if($user->phone)
								{{ $user->phone }}
							@else
								-
							@endif
						</td>
						<td>
							<?php $roles = array(); foreach($user->roles as $role) array_push($roles, str_replace('_', ' ', ucfirst($role['name']))); ?>
							{{ implode(', ', $roles) }}
						</td>
						<td>
							{{ Form::open(['class' => 'pull-right']) }}
								<span class="glyphicon glyphicon-remove btn btn-xs btn-danger"></span>
								{{ Form::hidden('id', $user->id) }}
							{{ Form::close() }}
						</td>
					</tr>
				@endforeach
				</tr>
			</tbody>
		</table>
		<div id="users-links">{{ $users->links() }}</div>
	</div>
</div>