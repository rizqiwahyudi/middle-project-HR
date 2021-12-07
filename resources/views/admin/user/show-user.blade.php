@extends('layouts.dashboard')

@section('title', '- Detail User')
@section('breadcrumb', 'Detail User')

@section('content')

<div class="content mt-3">
	<div class="animated fadeIn">
		<div class="col-md-8 offset-md-2">
            <aside class="profile-nav alt">
                <section class="card">
                    <div class="card-header user-header alt bg-dark">
                        <div class="media">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{asset('/sufee/images/example.png')}}">
                            </a>
                            <div class="media-body">
                                <h2 class="text-light display-6">{{$user->first_name}} {{$user->last_name}}</h2>
                                <p><b>{{$user->department->name}}</b> in <b>{{$user->company->name}}</b><br>
                                	<small class="text-muted">{{$user->role}}</small></p>
                            </div>
                        </div>
                    </div>


                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="mailto:{{$user->email}}"> <i class="fa fa-envelope-o"></i> Email <span class="badge badge-primary pull-right"><i class="fa fa-external-link"></i></span></a>
                        </li>
                        <li class="list-group-item">
                            <a href="tel:{{$user->telepon}}"> <i class="fa fa-phone"></i> Phone <span class="badge badge-primary pull-right"><i class="fa fa-external-link"></i></span></a>
                        </li>
                    </ul>

                </section>
            </aside>
        </div>
	</div>
</div>

@endsection