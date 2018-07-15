@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12 mx-auto">
			<div class="card mt-4">
				<div class="card-header"><h3>List of Users:</h3></div>
				<div class="card-body">
					<div class="table-responsive-md">
						<table class="table table-dark table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Role</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@forelse($users as $user)
								<tr>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->role}}</td>
								<td>
								<button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#update{{$user->id}}"><i class="fas fa-pencil-alt"></i> Update</button>
								<button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#password{{$user->id}}"><i class="fas fa-key"></i> Change Password</button>
								{{--           {!!Form::open(['action' => ['HomeController@destroy', $user->id], 'method' => 'POST'])!!}
								          {{Form::hidden('_method', 'DELETE')}}
								          {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
								          {!!Form::close()!!} --}}
								<form class="delete mt-1" action="{{ route('destroyuser', $user->id) }}" method="POST">
								<input type="hidden" name="_method" value="DELETE">
								<input type="hidden" name="_token" value="{{ csrf_token() }}" />

								<button type="submit" class="btn btn-outline-danger" value="Delete"><i class="fas fa-trash-alt"></i> Delete</button>
								</form>

								</td>
								</tr>

									<!-- Update User Modal-->
									<div class="modal fade" id="update{{$user->id}}">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">

												<!-- Modal Header -->
												<div class="modal-header">
												<h4 class="modal-title">Update User: {{$user->name}}</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>

												<form class="update" action="{{ route('updateuser', $user->id) }}" method="POST">
												<!-- Modal body -->
												<div class="modal-body">
													  <div class="form-group">
													    <label for="email">Name:</label>
													    <input type="name" class="form-control" name="name" value="{{$user->name}}">
													  </div>
													  <div class="form-group">
													    <label for="pwd">Email:</label>
													    <input type="email" class="form-control" name="email" value="{{$user->email}}">
													  </div>
														<div class="form-group">
													    <label for="pwd">Role:</label>
													    <input type="role" class="form-control" name="role" value="{{$user->role}}">
													  </div>
													<input type="hidden" name="_method" value="PUT">
													<input type="hidden" name="_token" value="{{ csrf_token() }}" />
												</div>

												<!-- Modal footer -->
												<div class="modal-footer">
												<button type="submit" class="btn btn-outline-info" value="Delete"><i class="fas fa-pencil-alt"></i> Update</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
												</div>
												</form>
											</div>
										</div>
									</div>


									<!-- View Users Modal-->
									<div class="modal fade" id="password{{$user->id}}">
										<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">

										<!-- Modal Header -->
										<div class="modal-header">
										<h4 class="modal-title">Change Password:</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

										<form class="update" action="{{ route('passwordupdate', $user->id) }}" method="POST">
										<!-- Modal body -->
										<div class="modal-body">
											<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
											<label for="password" class="control-label">New Password:</label>
											<input id="password" type="password" class="form-control" name="password" required>


												@if ($errors->has('password'))
												<span class="help-block">
												<strong>{{ $errors->first('password') }}</strong>
												</span>
												@endif

											</div>

											<div class="form-group">
											<label for="password-confirm" class="control-label">Confirm New Password:</label>
											<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
											<input type="hidden" name="_method" value="PUT">
											<input type="hidden" name="_token" value="{{ csrf_token() }}" />
											</div>
										</div>

										<!-- Modal footer -->
										<div class="modal-footer">
										<button type="submit" class="btn btn-outline-warning" value="Delete"><i class="fas fa-key"></i> Change Password</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
										</form>
										</div>
										</div>
									</div>


								@empty
								<tr>
								<td>No Users</td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection