@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 {{-- col-md-offset-2 --}}">
        <div class="jumbotron mt-3">
            <h3 class="text-center">Welcome to Admin Dashboard</h3>
        </div>

        <div class="card-deck">
          <a class="card bg-primary" href="{{ route('viewusers') }}">
            <img class="card-img-top" src="/storage/cover_images/user_view.png" alt="Card image">
            <div class="card-body text-center text-light">
              <h4>View Users</h4>
            </div>
          </a>
          <a class="card bg-warning" href="{{ route('register') }}">
            <img class="card-img-top" src="/storage/cover_images/users3_add.png" alt="Card image">
            <div class="card-body text-center text-light">
              <h4>Add Users</h4>
            </div>
          </a>
          <a class="card bg-success" data-toggle="modal" href="#addtopics">
            <img class="card-img-top" src="/storage/cover_images/scroll2_add.png" alt="Card image">
            <div class="card-body text-center text-light">
              <h4>Add Topics</h4>
            </div>
          </a>
          <a class="card bg-danger" data-toggle="modal" href="#viewthreads">
            <img class="card-img-top" src="/storage/cover_images/document_view.png" alt="Card image">
            <div class="card-body text-center text-light">
              <h4>View Threads</h4>
            </div>
          </a> 
          <a class="card bg-info" data-toggle="modal" href="#viewcomments">
            <img class="card-img-top" src="/storage/cover_images/messages.png" alt="Card image">
            <div class="card-body text-center text-light">
              <h4>View Comments</h4>
            </div>
          </a> 
        </div>

    </div>





  <!-- Add Topics Modal-->
  <div class="modal fade" id="addtopics">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">List of Topics:</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <div class="row">
            @forelse($tags as $tag)
            <p class="col-md-6 pl-5">
              <strong>{{$tag->name}}</strong>
            </p>
                <form class="col-md-4 delete" action="{{ route('deletetopic', $tag->id) }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <button type="submit" class="btn btn-outline-danger" value="Delete"><i class="fas fa-trash-alt"></i> Delete</button>
                </form>
            @empty
            <p>No Topics</p>
            @endforelse
          </div>
            <h4 class="mt-3">Add New Topic:</h4>
                <form class="form-inline ml-3" action="{{ route('addtopic') }}" method="GET">
                <input type="text" class="form-control mr-4" name="name">

                <button type="submit" class="btn btn-outline-success"><i class="fas fa-plus-circle"></i> Add</button>
                </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


                  <!-- View Comments Modal-->
                <div class="modal fade" id="viewcomments">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                      <h4 class="modal-title">List of Comments:</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>


                      <!-- Modal body -->
                      <div class="modal-body">


          <div class="table-responsive-md">
            <table class="table table-dark table-hover">
              <thead>
                <tr>
                  <th>Comment</th>
                  <th>Thread</th>
                  <th>Posted By</th>
                  <th>Date Commented</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($comments as $comment)
                <tr>
                <td>{!!$comment->body!!}</td>
                <td>{!!$comment->title!!}</td>
                <td>{{$comment->name}}</td>
                <td>{{$comment->created_at}}</td>
                <td>
{{--                 <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#update{{$user->id}}"><i class="fas fa-pencil-alt"></i> Update</button>
                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#password{{$user->id}}"><i class="fas fa-key"></i> Change Password</button>
                          {!!Form::open(['action' => ['HomeController@destroy', $user->id], 'method' => 'POST'])!!}
                          {{Form::hidden('_method', 'DELETE')}}
                          {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
                          {!!Form::close()!!} --}}
                <form class="delete mt-1" action="{{ route('destroycomment', $comment->id) }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <button type="submit" class="btn btn-outline-danger" value="Delete"><i class="fas fa-trash-alt"></i> Delete</button>
                </form>

                </td>
                </tr>

                @empty
                <tr>
                <td>No Comments</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>



                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>

                    </div>
                  </div>
                </div>

                  <!-- Thread View Modal-->
                <div class="modal fade" id="viewthreads">
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                      <h4 class="modal-title">List of Threads:</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>


                      <!-- Modal body -->
                      <div class="modal-body">


          <div class="table-responsive-md">
            <table class="table table-dark table-hover">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Subject</th>
                  <th>Posted By</th>
                  <th>Date Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($threads as $thread)
                <tr>
                <td>{{$thread->subject}}</td>
                <td>{!!$thread->thread!!}</td>
                <td>{{$thread->name}}</td>
                <td>{{$thread->created_at}}</td>
                <td>
{{--                 <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#update{{$user->id}}"><i class="fas fa-pencil-alt"></i> Update</button>
                <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#password{{$user->id}}"><i class="fas fa-key"></i> Change Password</button>
                          {!!Form::open(['action' => ['HomeController@destroy', $user->id], 'method' => 'POST'])!!}
                          {{Form::hidden('_method', 'DELETE')}}
                          {{Form::submit('Delete', ['class' => 'btn btn-outline-danger'])}}
                          {!!Form::close()!!} --}}
                <form class="delete mt-1" action="{{ route('destroythread', $thread->id) }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <button type="submit" class="btn btn-outline-danger" value="Delete"><i class="fas fa-trash-alt"></i> Delete</button>
                </form>

                </td>
                </tr>

                @empty
                <tr>
                <td>No Threads</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>



                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      </div>

                    </div>
                  </div>
                </div>


</div>
@endsection
