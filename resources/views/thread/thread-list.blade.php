@forelse($threads as $thread)
<div class="card mb-3">
	<div class="card-header bg-warning">
		<a href="thread/{{$thread->id}}" class="card-link">
		<h4 class="mt-2">{{$thread->subject}}</h4>
		</a>
	</div>
	<div class="card-body">
		
		<p class="card-text">{!!str_limit($thread->thread,100)!!}</p>
		
		<p class="card-text">Posted by <a href="/user/profile/{{$thread->user->name}}" class="card-link">{{$thread->user->name}}</a> {{$thread->created_at->diffForHumans()}}</p>
	</div>

</div>

@empty

		<h4>No threads</h4>

@endforelse
