@extends('layouts.app')

@section('content')

<div class="jumbotron text-center mt-4">
  @if($user->role!='admin')
  
	<h1>User Profile</h1>
  @else
  <h1>Admin Profile</h1>
  @endif
</div>

<div class="row">
	<div class="col-md-3">
		<div class="dp">
<div class="zoom-effect-container">
  <div class="image-card">
        
      
      @if(Auth::user()->id==$user->id)
            @if(is_null($user->cover_image))
            <a data-toggle="modal" href="#picture{{$user->id}}" title="Click to change"><img src="/storage/cover_images/noimage.jpg" class="img-thumbnail img-fluid" alt="Profile Image"></a>      
            @else
            <a data-toggle="modal" href="#picture{{$user->id}}" title="Click to change"><img src="/storage/cover_images/{{$user->cover_image}}" class="img-thumbnail img-fluid" alt="Profile Image"></a>
            @endif
      @else
            @if(is_null($user->cover_image))
            <a data-toggle="modal" href="#" title="Click to change"><img src="/storage/cover_images/noimage.jpg" class="img-thumbnail img-fluid" alt="Profile Image"></a>      
            @else
            <a data-toggle="modal" href="#" title="Click to change"><img src="/storage/cover_images/{{$user->cover_image}}" class="img-thumbnail img-fluid" alt="Profile Image"></a>
            @endif
      @endif
    </div>
   </div>   
      
		<h3 class='mt-2'>{{$user->name}}</h3>
    @if(Auth::user()->id==$user->id)
    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#update{{$user->id}}"><i class="fas fa-pencil-alt"></i> Update Details</button>
    <button type="button" class="btn btn-outline-warning mt-2" data-toggle="modal" data-target="#password{{$user->id}}"><i class="fas fa-key"></i> Change Password</button>
    @endif
      </div>
	</div>
	<div class="col-md-9">
    @if($user->role!='admin')
        <h3>{{$user->name}}'s Latest Threads</h3>

        @forelse($threads as $thread)
          <h5>{{$thread->subject}}</h5>
        @empty
          <h5>No threads yet</h5>
        @endforelse
    <br>
		<hr>

		<h3>{{$user->name}}'s Latest Comments</h3>

		@forelse($comments as $comment)
			<h5>{{$user->name}} commented on <a href="{{route('thread.show', $comment->commentable->id)}}">{{$comment->commentable->subject}}</a> {{$comment->created_at->diffForHumans()}}</h5>
		@empty
			<h5>No comments yet</h5>
		@endforelse
    @else
        <h1>Website Statistics:</h1>
        <hr>
        <h4 class='mb-1'>Total number of created Threads: {{count(App\Thread::all())}}</h4>

        <hr>
        <h4 class='mt-1'>Total number of posted Comments/Replies: {{count(App\Comment::all())}}</h4>        
    @endif

	</div>
</div>

									<!-- Update User Modal-->
									<div class="modal fade" id="update{{$user->id}}">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">

												<!-- Modal Header -->
												<div class="modal-header">
												<h4 class="modal-title">Update User: {{$user->name}}</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>

												<form class="update" action="{{ route('userprofileupdate', $user->id) }}" method="POST">
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


									<!-- Change Password Modal-->
									<div class="modal fade" id="password{{$user->id}}">
										<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">

										<!-- Modal Header -->
										<div class="modal-header">
										<h4 class="modal-title">Change Password:</h4>
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										</div>

										<form class="update" action="{{ route('userprofilepasswordupdate', $user->id) }}" method="POST">
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

									<!-- Update Profile Picture Modal-->
									<div class="modal fade" id="picture{{$user->id}}">
										<div class="modal-dialog modal-dialog-centered">
											<div class="modal-content">

												<!-- Modal Header -->
												<div class="modal-header">
												<h4 class="modal-title">Update Profile Picture: {{$user->name}}</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>

												<form class="update" action="{{ route('updateprofilepicture', $user->id) }}" method="POST" enctype="multipart/form-data">
												<!-- Modal body -->
												<div class="modal-body">
        <!--                    <div class="zoom-effect-container">
                            <div class="image-card"> -->
                          
                          @if(is_null($user->cover_image))
                          <img class="mx-auto d-block mb-3 img-fluid" src="/storage/cover_images/noimage.jpg">
                          @else
                          <img class="mx-auto d-block mb-3 img-fluid" src="/storage/cover_images/{{$user->cover_image}}">
                          @endif
   <!--                           </div>
                              </div>  -->
													  <div class="form-group mt-2">
                              {{Form::file('cover_image')}}
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

@endsection


