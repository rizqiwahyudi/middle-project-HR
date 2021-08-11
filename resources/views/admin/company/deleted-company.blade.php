@extends('layouts.dashboard')

@section('title', '- Deleted Companies')
@section('breadcrumb', 'Deleted Companies')

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
                                <strong class="card-title">Deleted Companies</strong>
                            </div>
                            <div class="card-body">
                                <a href="{{route('companies.index')}}" class="btn btn-outline-primary">Kembali</a>
                                <a href="{{route('deleteAll.companies')}}" class="btn btn-outline-danger" onclick="return confirm('Apakah Anda Yakin Delete Permanen ?');">Delete All</a>
                                <a href="{{route('restoreAll.companies')}}" class="btn btn-outline-success">Restore All</a><br><br>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Website / URL</th>
                                        <th>Deleted At</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($companies as $company)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$company->name}}</td>
                                            <td>{{$company->website_url}}</td>
                                            <td>{{$company->deleted_at}}</td>
                                            <td>
                                                <a href="{{route('restore.company', [$company->id])}}" class="btn btn-sm btn-outline-primary">Restore</a>
                                                <a href="{{route('deletePermanent.company', [$company->id])}}" class="btn btn-sm btn-outline-danger" onclick="return confirm('Apakah Anda Yakin Delete Permanen ?');">Delete</a>
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
