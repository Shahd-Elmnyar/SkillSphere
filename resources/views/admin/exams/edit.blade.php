@extends('admin.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"> Edit Exam</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Exam</li>
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
                <!-- <card body> -->
                <div class="col-12 pb-3">
                    @include("admin.inc.errors")
                    <form method="POST" action="{{url("dashboard/exams/update/{$exams->id}")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name(en)</label>
                                        <input type="text" class="form-control" value="{{$exams->name('en')}}" name="name_en">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Name(ar)</label>
                                        <input type="text" class="form-control"value="{{$exams->name('ar')}}" name="name_ar">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description(en)</label>
                                <textarea type="text" class="form-control" name="desc_en">{{$exams->description('en')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Description(ar)</label>
                                <textarea type="text" class="form-control" name="desc_ar">{{$exams->description('ar')}}</textarea>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Skill</label>
                                        <select class="Custom-select form-control"  id= "edit-form-cat-id" name="skill_id">
                                            @foreach($skills as $skill)
                                                <option value="{{$skill->id}}" @if($skill->id == $exams->skill_id) selected @endif>{{$skill->name('en')}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <!-- <label>Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="img" value= "{{$exams->img}}">
                                                <label class="custom-file-label">choose file</label>
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Difficulty</label>
                                        <input type="number" class="form-control"value="{{$exams->difficulty}}" name="difficulty">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Duration(mins)</label>
                                        <input type="number" class="form-control"value="{{$exams->duration_mins}}" name="duration_mins">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">Submit</button>
                                <a href="{{url()->previous()}}" class="btn btn-primary">back </a>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection