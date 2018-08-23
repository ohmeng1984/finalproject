@extends('layouts.app')

@section('content')
		<div class="jumbotron text-center mt-4">
    	<h1>{{$title}}</h1>
    	</div>
		{!! Breadcrumbs::render('groups') !!}

    
  <div class="row">
      <div class="col-md-12 bg-info rounded-circle mb-3">
        <h1 class="text-center">Search Result: <i class="text-white">{{$query}}</i></h1>
      </div>
      <div class="col-md-6 bg-secondary rounded-left">
        <h3 class="bg-warning text-center rounded mt-3">Search By Name:</h3>
        @if (count($usernames) == 0)
          <p class="text-center text-white">Sorry - no matches. Please try some different terms.</p>
        @elseif (count($usernames) >= 1)
            @foreach($usernames as $username)
            <p class="text-center text-white"><a href="/user/profile/{{$username->name}}" class="text-white">{{$username->name}}</a></p>
            @endforeach
        @endif
      </div>
      <div class="col-md-6 bg-secondary rounded-right">
        <h3 class="bg-warning text-center rounded mt-3">Search By Email:</h3>
        @if (count($usernames) == 0)
          <p class="text-center text-white">Sorry - no matches. Please try some different terms.</p>
        @elseif (count($usernames) >= 1)
            @foreach($useremails as $useremails)
            <p class="text-center text-white"><a href="/user/profile/{{$useremails->name}}" class="text-white">{{$useremails->email}}</a></p>
            @endforeach
        @endif
      </div>
    
      <div class="col-md-3">
      </div>
    
      <div class="col-md-6 bg-secondary rounded-bottom">
        <h3 class="bg-warning text-center rounded mt-3">Search By Thread:</h3>
        @if (count($titles) == 0)
          <p class="text-center text-white">Sorry - no matches. Please try some different terms.</p>
        @elseif (count($titles) >= 1)
            @foreach($titles as $title)
            <p class="text-center text-white"><a href="/thread/{{$title->id}}" class="text-white">{{$title->subject}}</a></p>
            @endforeach
        @endif
      </div>
    
      <div class="col-md-3">
      </div>

  </div>
@endsection