@extends('layouts.dashboard')

@section('title', '- Detail Company')
@section('breadcrumb', 'Detail Company')

@section('content')

<div class="content mt-3">
	<div class="animated fadeIn">
		<div class="col-md-8 offset-md-2">
            <aside class="profile-nav alt">
                <section class="card">
                    <div class="card-header user-header alt bg-dark">
                        <div class="media">
                            <a href="#">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="Company Logo" src="{{Storage::url('public/images/').$company->logo}}">
                            </a>
                            <div class="media-body">
                                <h2 class="text-light display-6">{{$company->name}}</h2>
                            </div>
                        </div>
                    </div>


                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="mailto:{{$company->email}}"> <i class="fa fa-envelope-o"></i> Email <span class="badge badge-primary pull-right"><i class="fa fa-external-link"></i></span></a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{$company->website_url}}"> <i class="fa fa-globe"></i> Site <span class="badge badge-primary pull-right"><i class="fa fa-external-link"></i></span></a>
                        </li>
                    </ul>

                </section>
            </aside>
        </div>
	</div>
</div>

@endsection