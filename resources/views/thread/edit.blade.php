@extends('layouts.app')

@section('content')

		<br>
    	<div class="row">
            @include('pages.topic-list')
    		<div class="col-md-9">
		<h4>Edit Thread</h4>
            <form class="form-vertical" action="{{route('thread.update',$thread->id)}}" method="post" role="form"
                  id="create-thread-form">
                {{csrf_field()}}
                {{method_field('put')}}
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" name="subject" id="" placeholder="Input..."
                           value="{{$thread->subject}}">
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
                    <textarea class="form-control" name="thread" id="" placeholder="Input..."> {{$thread->thread}} </textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            </div>
		</div>

@endsection



