@extends('layouts.app')

@section('content')
    <br>
      <div class="row">
            @include('pages.topic-list')
        <div class="col-md-9">
<h4>Create Thread</h4>
{{--     {!! Form::open(['action' => 'ThreadController@store', 'method' => 'POST']) !!}
        <div class="form-group">
         {{Form::label('subject', 'Subject')}}
          {{Form::text('subject', '', ['class' => 'form-control', 'placeholder' => 'Subject'] )}}
        </div>

        <div class="form-group">
         {{Form::label('type', 'Type')}}
          
        </div>        

        <div class="form-group">
           {{Form::label('thread', 'Thread')}}
           {{Form::textarea('thread', '', ['class' => 'form-control', 'placeholder' => 'Thread'] )}}
        </div>
        <div class="form-group">
          {!! NoCaptcha::display() !!}
          
        </div>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!} --}}

            <form class="form-vertical" action="{{route('thread.store')}}" method="post" role="form"
                  id="create-thread-form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="" placeholder="Input..."
                           value="{{old('subject')}}">
                </div>

                <div class="form-group">
                    <label for="tags">Tags</label>
                    <select class="form-control" name="tags" id="tag">
                      @foreach($tags as $tag)
                      <option value="{{$tag->id}}">{{$tag->name}}</option>
                      @endforeach

                    </select>
                </div>

                <div class="form-group">
                    <label for="thread">Thread</label>
                    <textarea class="form-control" name="thread" id="" placeholder="Input..."
                    > {{old('thread')}}</textarea>
                </div>


{{--                  <div class="form-group">
                   {!! NoCaptcha::display() !!}
                </div>  --}}

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            </div>
    </div>  
@endsection