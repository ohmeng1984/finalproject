@extends('layouts.app')

@section('content')
		<div class="jumbotron text-center mt-4">
    	<h1>{{$title}}</h1>
    	</div>
		{!! Breadcrumbs::render('about') !!}
  
    <div class="card bg-light">
      <div class="card-body">
        <p class="lead font-weight-bold">Welcome to Click Side, your number one source about the latest trends in technology. We're dedicated to giving you the very best news, with a focus on fun, excitement and uniqueness.</p>
        <p class="lead font-weight-bold">Founded in 2018 by Mel, Click Side has come a long way from its beginnings in Tuitt Bootcamp. When Mel first started out, his passion for technology drove him to study web developing, and gave him the impetus to turn hard work and inspiration into a booming web forum.</p>
        <p class="lead font-weight-bold">We hope you enjoy our site as much as we enjoy sharing them to you. If you have any questions or comments, please don't hesitate to contact us.</p>

<p class="lead font-weight-bold">Sincerely,<br>
  Mel, Web Admin.</p></div>
</div>

    <div class="card bg-light mt-4">
      <div class="card-body">
        <h3 class="text-center mb-5">Location</h3>
        <div class="row">
          <div class="col-md-6">
            <div class="mapouter"><div class="gmap_canvas"><iframe width="350" height="350" id="gmap_canvas" src="https://maps.google.com/maps?q=tuitt&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.pureblack.de"></a></div><style>.mapouter{text-align:center;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div>  
          </div>
          <div class="col-md-6">
            <h4>Click Side</h4>
                    <p class="lead font-weight-bold">
          Tuitt Incorporated<br>
          3rd Floor Caswynn Building, No. 134<br>
          Timog Avenue, Sacred Heart, Diliman, Quezon City, 1103<br>
          Metro Manila<br>
          +63987-6543210
        </p>
          </div>
        </div>
      </div>
</div>

@endsection