@extends('layouts.dashboard')

@section('title', '- Data Company')
@section('breadcrumb', 'Data Company')

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
                                <strong class="card-title">Data Company</strong>
                            </div>
                            <div class="card-body">
                                <a href="" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Add Company</a><br><br>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered table-responsive">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Logo</th>
                                        <th>Website / URL</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($companies as $company)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$company->name}}</td>
                                            <td>
                                                <a href="mailto:{{$company->email}}">{{$company->email}}</a>
                                            </td>
                                            <td>{{$company->logo}}</td>
                                            <td>
                                                <a href="{{$company->website_url}}" target="_blank">{{$company->website_url}}</a>
                                            </td>
                                            <td>
                                                <a href=""><i class="fa fa-eye"></i></a>
                                                <a href=""><i class="fa fa-edit"></i></a>
                                                <a href="" onclick="return confirm('Apakah anda yakin ?')"><i class="fa fa-trash-o"></i></a>
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
