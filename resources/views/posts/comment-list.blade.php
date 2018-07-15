                    
                <div class="card">
                    <div class="card-body">

                    	<div class="row">
                    		<div class="col-md-9">
                    			{!!$comment->body!!}
                          <img style="width:30%"  src="/storage/cover_images/{{$comment->cover_image}}">
                    		</div>
                    		<div class="col-md-3">
                    			@if(!is_null($thread->solution))
	                    			@if($thread->solution==$comment->id)
	                    			<button class="btn btn-success btn-sm ml-4"><i class="far fa-check-circle"></i> Solution</button>
	                    			@endif
	                    		@else
{{--                               @if(auth()->check())
                                @if(Auth::user()->id===$thread->user_id) --}}

{{--                             			<form action="{{route('markAsSolution')}}" method="POST">
                            			{{csrf_field()}}
                            			<input type="hidden" name="threadId" value="{{$thread->id}}">
                            			<input type="hidden" name="solutionId" value="{{$comment->id}}">
                            			<button type="submit" class="btn btn-success btn-sm ml-4" id="{{$comment->id}}" value="Mark As Solution"><i class="far fa-check-circle"></i> Mark as Solution</button>
                            			</form> --}}
                                            @can('update', $thread)
                                              <button  class="btn btn-success btn-sm ml-4" onclick="markAsSolution('{{$thread->id}}','{{$comment->id}}', this)"><i class="far fa-check-circle"></i> Mark as Solution</button>
                                            @endcan
{{--                                 @endif
                              @endif --}}
                    			@endif
                    		</div>
                    	</div>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-md-8">
                          - {{$comment->user->name}}
                        </div>
                        <div class="col-md-4">

                          @if(!Auth::guest())
                                  @if(Auth::user()->id===$comment->user_id)
                                  <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                     <i class="fas fa-plus-circle"></i> Comment Options
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" data-toggle="modal" href="#{{$comment->id}}"><i class="fas fa-pencil-alt"></i> Edit Comment</a>
                                          {!!Form::open(['action' => ['CommentController@destroy', $comment->id], 'method' => 'POST'])!!}
                                          {{Form::hidden('_method', 'DELETE')}}
                                          {{Form::submit('Delete Comment', ['class' => 'dropdown-item'])}}
                                          {!!Form::close()!!}
                                  </div>
                                  @endif

                                  <button type="button" class="btn btn-warning btn-sm float-right" data-toggle="collapse" data-target="#collapse{{$comment->id}}">
                                     <i class="fas fa-plus-circle"></i> Reply
                                  </button>

                          @endif

                        </div>
                      </div>
                      <button class="btn btn-sm btn-default" id="{{$comment->id}}-count">{{$comment->likes()->count()}}</button>
                      <button class="btn btn-sm btn-default {{$comment->isLiked()?"liked":""}}" onclick="likeIt('{{$comment->id}}', this)"><i class="fas fa-heart"></i> Like</button>

                    </div>
                </div>
                <br>
           <!-- The Modal for Edit Comment -->
        <div class="modal fade" id="{{$comment->id}}">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <!-- Modal Header -->
                {!! Form::open(['action' => ['CommentController@update', $comment->id], 'method' => 'POST']) !!}
              <div class="modal-header">
                <h4 class="modal-title">Edit Comment</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                        <div class="form-group">
                           {{Form::textarea('body', $comment->body, ['class' => 'form-control'] )}}
                        </div>
                        {{Form::hidden('_method', 'PUT')}}
              </div>

              <!-- Modal footer -->
              <div class="modal-footer">
                        {{Form::submit('Edit', ['class' => 'btn btn-success'])}}
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
              </div>
                {!! Form::close() !!}

            </div>
          </div>
        </div>
