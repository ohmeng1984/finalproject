@extends('layouts.app')

@section('content')
        <br>


        <div class="row mt-3">
            @include('pages.topic-list')
            <div class="col-md-9">



                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8"><h4 class="mt-3 ml-2">{{$thread->subject}}</h4></div>
                            <div class="col-md-4">
{{--                                 @if(!Auth::guest())
                                @if(Auth::user()->id===$thread->user_id) --}}
                                @can('update', $thread)
                          <div class="btn-group mt-3 ml-5" id="createpost" >
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                               <i class="fas fa-plus-circle"></i> Thread Options
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{$thread->id}}/edit"><i class="fas fa-pencil-alt"></i> Edit Thread</a>
                                    {!!Form::open(['action' => ['ThreadController@destroy', $thread->id], 'method' => 'POST'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete Thread', ['class' => 'dropdown-item'])}}
                                    {!!Form::close()!!}
                            </div>
                          </div>
                                @endcan
{{--                                 @endif
                                @endif --}}
                                
                            </div>
                        </div>
                        </div>
                    <div class="card-body">{!!$thread->thread!!}</div> 
                    <div class="card-footer">
                        - {{$thread->user->name}}





                    </div>
                </div>
                <br>
    @foreach($thread->comments as $comment)                
        @include('posts.comment-list')

        @include('posts.reply-list')
        
    @endforeach


                {{-- Comment Form --}}
                @if(!Auth::guest())
                <br>
                <div class="comment-form">
                    {!! Form::open(['action' => ['CommentController@addThreadComment', $thread->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                        <h4>Add Comment:</h4>
                           {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Comment'] )}}
                        </div>

                        <div class="form-group">
                            {{Form::file('cover_image')}}
                        </div>

{{--                         <div class="form-group">
                            {{Form::date('name', \Carbon\Carbon::now())}}
                        </div> --}}
 
                        {{Form::submit('Post Comment', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}

                </div>
                @endif

            </div>

@endsection