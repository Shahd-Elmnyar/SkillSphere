@extends('admin.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{$exams->name('en')}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('dashboard/exams')}}">Exams</a></li>
                        <li class="breadcrumb-item active">{{$exams->name('en')}}</li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Exam details</h3>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-md">
                            <tbody>
                                <tr>
                                    <th>Name(en)</th>
                                    <td>
                                        {{$exams->name('en')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Name(ar)</th>
                                    <td>
                                        {{$exams->name('ar')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description(en)</th>
                                    <td>
                                        {{$exams->description('en')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Description(ar)</th>
                                    <td>
                                        {{$exams->description('ar')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Skill</th>
                                    <td>
                                        {{$exams->skill->name('en')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <img src = "{{asset("uploads/$exams->img")}}" height ="200px" alt = "">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Questions number</th>
                                    <td>
                                        {{$exams->questions_number}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Duration mins</th>
                                    <td>
                                        {{$exams->duration_mins}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Difficulty</th>
                                    <td>
                                        {{$exams->difficulty}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Active</th>
                                    <td>
                                        @if($exams->active)
                                            <span class="badge bg-success">Yes</span>
                                            @else
                                            <span class="badge bg-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <!-- </card body> -->
                </div>
                <a href="{{url("dashboard/exams/show/$exams->id/questions")}}" class="btn btn-sm btn-success">Show Question</a>
                <a href="{{url()->previous()}}" class="btn btn-sm btn-primary">back</a>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection