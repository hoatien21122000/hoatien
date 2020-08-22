<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('login_controller.index') }}" class="nav-link"><i class="fas fa-home"></i>Home</a>
      </li>
    </ul>
  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item ">
        @if (Session::has('email_registrar'))
          <a class="nav-link"  href="{{ route('logout') }}">
          <i class="fas fa-sign-out-alt"></i>
            Logout
          </a>
          @else
          <a class="nav-link" href="{{ route('logout_teacher') }}">
          <i class="fas fa-sign-out-alt"></i>
            Logout
          </a>
        @endif
      </li>
      <!-- Notifications Dropdown Menu -->
      
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('login_controller.index') }}" class="brand-link">
      <img src="{{ asset('dist/img/df3c667a-c04a-11e7-a87a-2e995a9a3302.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <!-- <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
          <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('login_controller.index') }}" class="nav-link"><i class="fas fa-users"></i>HELLO<b style="color:#FF3333">
          @if (Session::has('registrar_name'))
                  {{ Session::get('registrar_name') }}
          @else(Session::has('teacher_name'))
                  {{ Session::get('teacher_name') }}
          @endif</a></b>
      </li>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open" id="li_manage_list">
            <a href="#" class="nav-link active" id="manage_list">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                 MANAGE
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            @if (Session::has('email_registrar'))
                        
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pathway_management.pathway_list') }}" class="nav-link" id="pathway_management">
                <i class="fas fa-arrow-alt-circle-right"></i>
                  <p>Major Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('academic_year_management.academic_year_list') }}" class="nav-link" id="academic_year_management">
                <i class="fas fa-arrow-alt-circle-right"></i>
                  <p>Academic Year Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('classes_management.choose_pathway_academic_year') }}" class="nav-link" id="class_management">
                <i class="fas fa-arrow-alt-circle-right"></i>
                  <p>Class Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('student_management.list_student') }}" class="nav-link" id="student_management">
                <i class="fas fa-arrow-alt-circle-right"></i>
                  <p>Student Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('subject_management.subject_list') }}" class="nav-link" id="subject_management">
                <i class="fas fa-arrow-alt-circle-right"></i>
                  <p>Subject Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('pathway_subject_management.ps_list') }}" class="nav-link" id="pathway_subject_management">
                <i class="fas fa-arrow-alt-circle-right"></i>
                  <p>Major-Subject Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('mark_management.choose_class_subject') }}" class="nav-link" id="mark_management">
                <i class="fas fa-arrow-alt-circle-right"></i>
                  <p>Mark Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('teacher_management.teacher_list') }}" class="nav-link" id="teacher_management">
                <i class="fas fa-arrow-alt-circle-right"></i>
                  <p>Teacher Management</p>
                </a>
              </li>
            </ul>
            @endif
            @if (Session::has('email'))
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('mark.mark_view') }}" class="nav-link" id="mark">
                <i class="fas fa-arrow-alt-circle-right"></i>
                  <p>Mark</p>
                </a>
              </li>
            </ul>
            @endif
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">MANAGE</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       @yield('content')
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.2
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.js')}}"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<!-- myscript  -->
<script src="{{asset('dist/js/myscript.js')}}"></script>
<script src="{{asset('js/sweetalert.min.js')}}"></script>
@stack('js')
</body>
</html>
