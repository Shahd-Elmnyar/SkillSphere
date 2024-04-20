@extends('admin.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">{{$exams->name('en')}} questions</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard/')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{url('dashboard/exams')}}">Exams</a></li>
                        <li class="breadcrumb-item"><a href="{{url("dashboard/exams/show/$exams->id")}}">{{$exams->name('en')}}</a></li>
                        <li class="breadcrumb-item active">Questions</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Exam Questions</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Options</th>
                                            <th>Right Answer</th>
                                            <th>Exam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($exams->questions as $question)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$question->title}}</td>
                                            <td>{{$question->option_1}} |<br>
                                                {{$question->option_2}} |<br>
                                                {{$question->option_3}} |<br>
                                                {{$question->option_4}} |
                                            </td>
                                            <td>
                                                {{$question->correct_answer}}
                                            </td>
                                            <td>{{$exams->name('en')}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                    <!-- </card body> -->
                    </div>
                </div>
                <a href="{{url()->previous()}}" class="btn btn-sm btn-primary">back </a>
                <a href="{{url("dashboard/exams")}}" class="btn btn-sm btn-primary">back to all exams</a>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection