@extends('layouts.app')

@section('title', '- User Dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User Dashboard') }} - <b>{{Auth::user()->username}}</b></div>

                <div class="card-body">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h6><i class="fas fa-check"></i><b>Success  {{session('success')}}</b></h6>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h6><i class="fas fa-times"></i><b> Error! {{session('error')}}</b></h6>
                        </div>
                    @endif

                    
                    <h5>First Name : {{Auth::user()->first_name}}</h5>

                    <h5>Last Name : {{Auth::user()->last_name}}</h5>

                    <h5>Email : {{Auth::user()->email}}</h5>

                    <h5>Telepon : {{Auth::user()->telepon}}</h5>
                    
                    <hr>
                    <br>

                    <h5>Company : {{Auth::user()->company->name}}</h5>

                    <h5>Department : {{Auth::user()->department->name}}</h5>

                    <hr>
                    <br>

                    <h5>Role : {{Auth::user()->role}}</h5>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
