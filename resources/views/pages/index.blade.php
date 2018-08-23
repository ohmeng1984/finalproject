@extends('layouts.app')

@section('content')
		<div class="jumbotron text-center mt-4">
    	<h1>{{$title}} - {{$name}}</h1>
    	</div>
		{!! Breadcrumbs::render('home') !!}
    @guest
    <div class="card bg-light">
      <div class="card-body">
        <p class="lead font-weight-bold">Welcome to Click Side. Take a moment to <a href="{{ route('register') }}">Sign up</a> and gain unlimited access and extra privileges that guests are not entitled to, such as:</p>
        <p class="lead font-weight-bold ml-5"><i class="far fa-snowflake fa-spin"></i> Ask support for computer & technology issues.</p>
        <p class="lead font-weight-bold ml-5"><i class="far fa-snowflake fa-spin"></i> Learn many tricks on different areas of technology.</p>
        <p class="lead font-weight-bold">All that and more! Registration is quick, simple and absolutely free. <a href="{{ route('register') }}">Join</a> our community today!</p>

      </div>
    </div>
    @else
     <div class="card bg-light">
      <div class="card-body">
        <p class="lead font-weight-bold">Welcome to Click Side Forum!</p>
        <p class="lead font-weight-bold">This forum was developed due to popular demand by technology enthusiast. They all want a positive and productive place to learn, discuss issues and support each other.</p>
        <p class="lead font-weight-bold">That's what this forum is all about! Positive solutions and respect for other members is the key to getting along here in Click Side. Hope you all contribute and enjoy the ambiance!</p>
        <p class="lead font-weight-bold">Check out all the important topics & great discussions so far - click recent posts at top of forum. Set up a good signature and introduce yourself!</p>

      </div>
    </div>
    @endguest
@endsection