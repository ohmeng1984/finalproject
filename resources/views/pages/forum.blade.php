@extends('layouts.app')

@section('content')
		<div class="jumbotron text-center mt-4">
    	<h1>Forums</h1>
    	</div>
		{!! Breadcrumbs::render('forum') !!}

    	<div class="row">
            @include('pages.topic-list')
    		<div class="col-md-9">
                <div class="row">
                    <div class="col-md-9"><h4>Threads</h4></div>
                    <div class="col-md-3">
                        @if(!Auth::guest())
                        <a class="btn btn-primary" id="createthread" href="{{'thread/create'}}"><i class="fas fa-plus-circle"></i> CREATE THREAD</a>
                        @endif
                    </div>
                </div>

    				

                    
    					@include('thread.thread-list')
                    
                        {{$threads->links()}}
            </div>
        </div>
@endsection