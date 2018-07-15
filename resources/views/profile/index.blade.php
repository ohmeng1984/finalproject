@extends('layouts.app')

@section('content')

<div class="jumbotron text-center mt-4">
	<h1>User Profile</h1>
</div>

<div class="row">
	<div class="col-md-3">
		<div class="dp">
			<img src="https://dummyimage.com/300x200/000/fff" alt="">
		</div>
		<h3>{{$user->name}}</h3>
	</div>
	<div class="col-md-9">
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
	</div>
</div>

@endsection