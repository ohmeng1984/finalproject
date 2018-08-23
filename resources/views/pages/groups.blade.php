@extends('layouts.app')

@section('content')
		<div class="jumbotron text-center mt-4">
    	<h1>{{$title}}</h1>
    	</div>
		{!! Breadcrumbs::render('groups') !!}
  <img src="/storage/cover_images/construction.jpg" class="img-thumbnail img-fluid mx-auto d-block" alt="Profile Image">
@endsection