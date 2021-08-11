@extends('layouts.dashboard')

@section('title', '- Data Department')
@section('breadcrumb', 'Data Department')

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
                                <strong class="card-title">Data Department</strong>
                            </div>
                            <div class="card-body">
                                <a href="{{route('departments.create')}}" class="btn btn-outline-primary"><i class="fa fa-plus"></i> Add Department</a>
                                <a href="{{route('getDeletedDepartments')}}" class="btn btn-outline-danger"><i class="fa fa-trash"> Trash</i></a><br><br>
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($departments as $department)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$department->name}}</td>
                                            <td>{{$department->description}}</td>
                                            <td>
                                                <a href="{{route('departments.edit', [$department->id])}}"><i class="fa fa-edit"></i></a>
                                                <form action="{{route('departments.destroy', [$department->id])}}" method="POST" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" style="border: none;" onclick="return confirm('Apakah anda yakin ?')">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
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
