<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>SKILLSPHERE|Dashboard</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('admin/css/fontawesome.all.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/css/adminlte.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">

                <span class="brand-text font-weight-light">SKILLSPHERE</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="{{url('dashboard/')}}" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                                <p>
                                    HOME
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('/')}}" class="nav-link">
                            <i class="nav-icon fas fa-globe"></i>
                                <p>
                                    back to website
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                        <!-- <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Sample Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Page one</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Page two</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{url('dashboard/categories')}}" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    categories
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('dashboard/skills')}}" class="nav-link">
                                <i class="nav-icon fas fa-brain"></i>
                                <p>
                                    skills
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('dashboard/exams')}}" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    exams
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{url('dashboard/students')}}" class="nav-link">
                            <i class="nav-icon fas fa-user-graduate"></i>
                                <p>
                                    students
                                </p>
                            </a>
                        </li>
                        @if(Auth::user()->role->name == "superadmin")
                        <li class="nav-item">
                            <a href="{{url('dashboard/admins')}}" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    admins
                                </p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{url('dashboard/messages')}}" class="nav-link">
                            <i class="nav-icon fas fa-envelope"></i>
                                <p>
                                    Messages
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        @yield('content')


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->

            <!-- Default to the left -->

        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('admin/js/jquery.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('admin/js/bootstrap.bundle.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('admin/js/adminlte.js')}}"></script>
    @yield('scripts')
</body>

</html>