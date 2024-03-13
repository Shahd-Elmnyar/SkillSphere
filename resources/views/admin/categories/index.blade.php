@extends('admin.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">categories</li>
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
                            <h3 class="card-title">All Categories</h3>
                            <div class="card-tools">
                                <!-- <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search" spellcheck="false" data-ms-editor="true">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>-->
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#add-modal">
                                    Add new
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name(en)</th>
                                        <th>Name(ar)</th>
                                        <th>Active</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$category->name('en')}}</td>
                                        <td>{{$category->name('ar')}}</td>
                                        <td>
                                            @if($category->active)
                                            <span class="badge bg-success">Yes</span>
                                            @else
                                            <span class="badge bg-danger">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" href="{{url("dashboard/categories/update")}}" class="btn btn-sm btn-info edit-btn" data-id="{{$category->id}}" data-name-en="{{$category->name('en')}}" data-name-ar="{{$category->name('ar')}}" data-toggle="modal" data-target="#edit-modal">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <a href="{{url("dashboard/categories/delete/$category->id")}}" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>

                                            @if($category->active)
                                            <a href="{{url("dashboard/categories/toggle/$category->id")}}" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-toggle-on"></i>
                                            </a>
                                            @else
                                            <a href="{{url("dashboard/categories/toggle/$category->id")}}" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-toggle-off"></i>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex my-3 justify-content-center">
                                {{$categories->links()}}
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
            @include('admin.inc.errors');
                <form method="POST" action="{{url("dashboard/categories/store")}}" id="add-form">
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
                @include('admin.inc.errors');
                <form method="POST" action="{{url("dashboard/categories/update")}}" id="edit-form">
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
@section('scripts')
<script>
    $('.edit-btn').click(function() {
        let id = $(this).attr('data-id');
        let nameEn = $(this).attr('data-name-en');
        let nameAr = $(this).attr('data-name-ar');
        console.log(nameEn, nameAr);
        $('#edit-form-id').val(id)
        $('#edit-form-name-en').val(nameEn)
        $('#edit-form-name-ar').val(nameAr)
    })
</script>
@endsection