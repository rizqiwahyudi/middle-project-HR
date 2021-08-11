@extends('layouts.dashboard')

@section('title', '- Admin Dashboard')

@section('content')

        <div class="content mt-3">

            @if (session('success'))
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Success</span> {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="col-sm-12">
                    <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-danger">Error !</span> {{session('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="animated fadeIn">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-four">
                                    <div class="stat-icon dib">
                                        <i class="ti-user text-muted"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">Users</div>
                                            <div class="stat-text">Total: {{$employeesCount}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-four">
                                    <div class="stat-icon dib">
                                        <i class="fa fa-tasks text-muted"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">Departments</div>
                                            <div class="stat-text">Total: {{$departmentsCount}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-four">
                                    <div class="stat-icon dib">
                                        <i class="fa fa-building-o text-muted"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
                                            <div class="stat-heading">Companies</div>
                                            <div class="stat-text">Total: {{$companiesCount}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data User</strong>
                            </div>
                            <div class="card-body">
                                <a href="{{route('getDeletedUsers')}}" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Trash</a><br><br>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($users as $user)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$user->username}}</td>
                                            <td>
                                                <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                            </td>
                                            <td>{{$user->role}}</td>
                                            <td>
                                                <a href="{{route('show.user', [$user->id])}}"><i class="fa fa-eye" title="User Detail"></i></a>
                                                <a href="{{route('edit.user', [$user->id])}}"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('user.delete', [$user->id])}}" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>

        </div> <!-- .content -->
@endsection
