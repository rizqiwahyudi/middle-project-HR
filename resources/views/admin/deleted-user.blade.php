@extends('layouts.dashboard')

@section('title', '- Deleted Users')
@section('breadcrumb', 'Deleted Users')

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

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Deleted Users</strong>
                            </div>
                            <div class="card-body">
                                <a href="{{route('dashboard.admin')}}" class="btn btn-outline-primary">Kembali</a>
                                <a href="{{route('deleteAll.users')}}" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda Yakin Delete Permanen ?');">Delete All</a>
                                <a href="{{route('restoreAll.users')}}" class="btn btn-outline-success">Restore All</a><br><br>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Deleted At</th>
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
                                            <td>{{$user->deleted_at}}</td>
                                            <td>
                                                <a href="{{route('restore.user', [$user->id])}}" class="btn btn-sm btn-outline-primary">Restore</a>
                                                <a href="{{route('deletePermanent.user', [$user->id])}}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda Yakin Delete Permanen ?');">Delete</a>
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
