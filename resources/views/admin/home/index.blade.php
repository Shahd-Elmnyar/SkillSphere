@extends('admin.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 bg-light p-4 shadow-sm rounded">
                    <h1 class="m-0 text-dark">Hello {{$adminName}}</h1>
                    <h4 class="m-0 text-secondary">your role is {{$adminRole}}</h4>
                    <p class="mt-3">
                        this dashboard for help you
                        <br><br> -add, edit, delete, activate and deactivate categories, skills, and exams
                        <br><br> -open and close exams for each student
                        <br><br> -read messages and respond to them
                    </p>
                    @if(Auth::user()->role->name == "superadmin")
                        <p class="mt-3">
                            -add admins and superadmins
                        </p>
                    @endif

                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
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

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection