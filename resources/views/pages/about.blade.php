@extends('layouts.app')

@section('content')
		<div class="jumbotron text-center mt-4">
    	<h1>{{$title}}</h1>
    	</div>
		{!! Breadcrumbs::render('about') !!}
@endsection