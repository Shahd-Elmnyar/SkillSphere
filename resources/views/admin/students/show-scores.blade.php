@extends('admin.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Show Scores {{$students->name}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">show scores {{$students->name}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('admin.inc.message')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">scores</h3>
                            <div class="card-tools">
                                <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" spellcheck="false" data-ms-editor="true">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>-->
                                <!-- <a href="{{url('dashboard/exams/create')}}" class="btn btn-sm btn-primary">
                                    Add new
                                </a> -->
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Exam</th>
                                        <th>Score</th>
                                        <th>Time(mins)</th>
                                        <th>At</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exams as $exam)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$exam->name('en')}}</td>
                                        <td>{{$exam->pivot->score}}</td>
                                        <td>{{$exam->pivot->time_min}}</td>
                                        <td>{{$exam->pivot->created_at}}</td>
                                        <td>{{$exam->pivot->status}}</td>
                                        <td>
                                        @if($exam->pivot->status =='closed')
                                            <a href="{{url("dashboard/students/open-exam/$students->id/$exam->id")}}" class="btn btn-sm btn-success">
                                                <i class="fas fa lock-open"></i>
                                            </a>
                                        @else
                                            <a href="{{url("dashboard/students/close-exam/$students->id/$exam->id")}}" class="btn btn-sm btn-danger">
                                                <i class="fas fa-lock"></i>
                                            </a>
                                        @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex my-3 justify-content-center">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
@endsection