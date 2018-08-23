                {{-- Reply to Comments --}}
                   
        <div class="row">
            <div class="col-1 order-1"></div>
            <div class="col-11 order-2">
              
                <div id="collapse{{$comment->id}}" class="collapse mb-4"> 
                {{-- Reply Form --}}

                <div class="comment-form">
                    {!! Form::open(['action' => ['CommentController@addReplyComment', $comment->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                        <h4>Add Reply:</h4>
                           {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Reply'] )}}
                        </div>
                         <div class="form-group">
                            {{Form::file('cover_image')}}
                        </div>
                        {{Form::submit('Post Reply', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}

                </div>
                </div>
              
                        @foreach($comment->comments as $reply)


              
                <div class="card">
                    <div class="card-body">
                      
                     <div class="media border p-3 border-0">
                      @if(is_null($reply->user->cover_image))
                       <a href="/user/profile/{{$reply->user->name}}" class="card-link"><img src="/storage/cover_images/noimage.jpg" alt="John Doe" class="img-fluid mr-3 mt-3 rounded" style="width:60px;"></a>
                      @else
                       <a href="/user/profile/{{$reply->user->name}}" class="card-link"><img src="/storage/cover_images/{{$reply->user->cover_image}}" alt="John Doe" class="img-fluid mr-3 mt-3 rounded" style="width:60px;"></a>
                      @endif
                      <div class="media-body">
                      <i>Posted on {{$reply->created_at}}</i></small></h4>
                      <p>{{$reply->user->email}}</p>
                      </div>
                    </div>
                      
                      
                      {!!$reply->body!!}
                      @if($reply->cover_image!='noimage.jpg')
                      <img style="width:30%"  src="/storage/cover_images/{{$reply->cover_image}}">
                      @endif
                    </div>
                    <div class="card-footer">by <a href="/user/profile/{{$reply->user->name}}" class="card-link">{{$reply->user->name}}</a>
                        @if(!Auth::guest())
                        @if(auth()->user()->id==$reply->user_id)
                          <div class="btn-group float-right">
                                <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown">
                                   <i class="fas fa-plus-circle"></i> Reply Options
                                </button>
                                <div class="dropdown-menu">
                                  <a class="dropdown-item" data-toggle="modal" href="#{{$reply->id}}"><i class="fas fa-pencil-alt"></i> Edit Reply</a>
                                        {!!Form::open(['action' => ['CommentController@destroy', $reply->id], 'class' => 'delete', 'method' => 'POST'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete Reply', ['class' => 'dropdown-item'])}}
                                        {!!Form::close()!!}
                                </div>
                          </div>
                        @endif
                        @endif
                    </div>
                </div>

           <!-- The Modal for Edit Reply-->
        <div class="modal fade" id="{{$reply->id}}">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">

              <!-- Modal Header -->
                {!! Form::open(['action' => ['CommentController@update', $reply->id], 'method' => 'POST']) !!}
              <div class="modal-header">
                <h4 class="modal-title">Edit Reply</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>

              <!-- Modal body -->
              <div class="modal-body">
                        <div class="form-group">
                           {{Form::textarea('body', $reply->body, ['class' => 'form-control'] )}}
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
            <br>
                        @endforeach

                </div>
                </div>
                <hr>
                    