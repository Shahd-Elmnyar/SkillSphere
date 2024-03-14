@extends('admin.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">exams</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">exams</li>
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
                            <h3 class="card-title">All Exams</h3>
                            <div class="card-tools">
                                <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" spellcheck="false" data-ms-editor="true">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>-->
                                <a href="{{url('dashboard/exams/create')}}" class="btn btn-sm btn-primary">
                                    Add new
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name(en)</th>
                                        <th>Name(ar)</th>
                                        <th>Image</th>
                                        <th>Skill</th>
                                        <th>Questions number</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exams as $exam)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$exam->name('en')}}</td>
                                        <td>{{$exam->name('ar')}}</td>
                                        <td>
                                            <img src="{{asset("uploads/$exam->img" )}}" height="50px" alt="">
                                        </td>
                                        <td>{{$exam->skill->name('en')}}</td>
                                        <td>{{$exam->questions_number}}</td>
                                        <td>
                                            @if($exam->active)
                                            <span class="badge bg-success">Yes</span>
                                            @else
                                            <span class="badge bg-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url("dashboard/exams/show/$exam->id")}}" class="btn btn-sm btn-primary ">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{url("dashboard/exams/show/$exam->id/questions")}}" class="btn btn-sm btn-success ">
                                                <i class="fas fa-question"></i>
                                            </a>
                                            <a href="{{url("dashboard/exams/edit/$exam->id")}}" class="btn btn-sm btn-info ">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{url("dashboard/exams/delete/$exam->id")}}" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            @if($exam->active)
                                            <a href="{{url("dashboard/exams/toggle/$exam->id")}}" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-toggle-on"></i>
                                            </a>
                                            @else
                                            <a href="{{url("dashboard/exams/toggle/$exam->id")}}" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-toggle-off"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex my-3 justify-content-center">
                                {{$exams->links()}}
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
<!-- /.content-wrapper -->
<div class="modal fade" id="add-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.inc.errors')
                <form method="POST" action="{{url("dashboard/exams/store")}}" id="add-form">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name(en)</label>
                                <input type="text" name="name_en" class="form-control" placeholder="Enter name in English">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name(ar)</label>
                                <input type="text" name="name_ar" class="form-control" placeholder="Enter name in Arabic">
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="add-form" class="btn btn-primary">submit</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @include('admin.inc.errors')
                <form method="POST" action="{{url("dashboard/exams/update")}}" id="edit-form">
                    @csrf
                    <input type="hidden" name="id" id="edit-form-id">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name(en)</label>
                                <input type="text" name="name_en" class="form-control" id="edit-form-name-en">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Name(ar)</label>
                                <input type="text" name="name_ar" class="form-control" id="edit-form-name-ar">
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" form="edit-form" class="btn btn-primary">submit</button>
            </div>
        </div>
    </div>
</div>

@endsection