@extends('layouts.app')

@section('content')
		<div class="jumbotron text-center mt-4">
    	<h1>{{$title}}</h1>
    </div>
		{!! Breadcrumbs::render('whatsnew') !!}

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Newest Member</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Newest Thread</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Newest Comment</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <h3 class="mt-3">New Members List:</h3>

        <div class="list-group">
          @foreach($users as $user)
            <a href="/user/profile/{{$user->name}}" class="list-group-item list-group-item-action list-group-item-info">{{$user->name}}</a>
          @endforeach
        </div>

    </div>
    <div id="menu1" class="container tab-pane fade"><br>
      <h3 class="mt-3">New Threads List:</h3>

        <div class="list-group">
          @foreach($threads as $thread)
            <a href="#" class="list-group-item list-group-item-action list-group-item-warning">{{$thread->subject}}</a>
          @endforeach
        </div>
      
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
      <h3 class="mt-3">New Comments List:</h3>
      
        <div class="list-group">
          @foreach($comments as $comment)
            <a href="#" class="list-group-item list-group-item-action list-group-item-success">Comment posted by {{$comment->name}} on {{$comment->title}} Thread</a>
          @endforeach
        </div>
      
    </div>
  </div>
    
@endsection