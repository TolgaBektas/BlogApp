<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/adminLTE/css/adminlte.min.css')}}">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">

  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2/css/sweetalert2.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('assets/plugins/toastr/toastr.min.css')}}"> 
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/plugins/summernote/summernote-bs4.min.css')}}">
  <!-- CodeMirror -->
  <link rel="stylesheet" href="{{asset('assets/plugins/codemirror/codemirror.css')}}">
  <link rel="stylesheet" href="{{asset('assets/plugins/codemirror/theme/monokai.css')}}">
@yield('css')

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- NAVBAR START -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- NAVBAR Sol Taraf START -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-sm-inline-block">
          <a href="{{ route('admin.index') }}" class="nav-link">Home Page</a>
        </li>
      </ul>
      <!-- NAVBAR Sol Taraf END -->



      <!-- NAVBAR Sag Taraf START -->
      <ul class="navbar-nav ml-auto">
        <!-- Bildirim Menu START -- >
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Bildirim</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
          </div>
        </li>
        <!-- Bildirim Menu END -->

        <!-- Cikis Yap START -->
        <form action="{{route('logout')}}" id="logout" method="POST">
        <li class="nav-item d-none d-sm-inline-block">
            @csrf
          <a type="submit" class="nav-link" onclick="document.getElementById('logout').submit();">Logout</a>
        </li>
    </form>
        <!-- Cikis Yap START -->
      </ul>
      <!-- NAVBAR Sag Taraf END -->

    </nav>
    <!-- NAVBAR END -->

    <!-- SIDEBAR START -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- LOGO START -->
      <a href="{{ route('admin.index') }}" class="brand-link">
        <img src="" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
      </a>
      <!-- LOGO END -->


      <div class="sidebar">
        <!-- SIDEBAR kullanici adi START -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <h5 class="m-0 text-light">Welcome, {{auth()->user()->name}}</h5>
          </div>
        </div>
        <!--SIDEBAR kullanici adi END -->
        <!-- SIDEBAR MENULER START -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{ route('admin.index') }}" class="nav-link">
                <i class="fas fa-home"></i>
                <p>Home Page</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.profile')}}" class="nav-link">
                <i class="fas fa-user"></i>
                <p>Profile</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('admin.logs')}}" class="nav-link">
                <i class="fas fa-clipboard-list"></i>
                <p>Logs</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-newspaper"></i>
                <p>Post
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.posts.index') }}" class="nav-link">
                    <i class="far fa-newspaper"></i>
                    <p>Posts</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.posts.post-add') }}" class="nav-link">
                    <i class="fas fa-plus-circle"></i>
                    <p>New Post</p>
                  </a>
                </li>                
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-list-ul"></i>
                <p>Category
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.categories.index') }}" class="nav-link">
                    <i class="fas fa-list-ul"></i>
                    <p>Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.categories.category-add') }}" class="nav-link">
                    <i class="fas fa-plus-circle"></i>
                    <p>New Category</p>
                  </a>
                </li>                
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-tag"></i>
                <p>Tag
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('admin.tags.index') }}" class="nav-link">
                    <i class="fas fa-tags"></i>
                    <p>Tags</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.tags.tag-add') }}" class="nav-link">
                    <i class="fas fa-plus-circle"></i>
                    <p>New Tag</p>
                  </a>
                </li>                
              </ul>
            </li>
           </ul>
        </nav>
        <!-- SIDEBAR MENULER END -->
      </div>

    </aside>
    <!-- SIDEBAR END -->

    <!-- ANASAYFA START-->
    <div class="content-wrapper">
      <!-- ANASAYFA BASLIK START -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home Page</a></li>
                <li class="breadcrumb-item active">@yield('title')</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- ANASAYFA BASLIK END -->
      <div class="content">
        <div class="container-fluid">
            @yield('content')

        </div>
    </div>
    </div>
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Tolga Bektaş
    
        </div>
        <!-- Default to the left -->
        <a href="{{ route('admin.index') }}">Home Page</a>
    </footer>
    </div>
        
    <!-- REQUIRED SCRIPTS -->

    <!-- Jquery -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- bs-custom-file-input -->
    <script src="{{asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>    
    <!-- Bootstrap -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/adminLTE/js/adminlte.min.js')}}"></script>
    
    <!-- SweetAlert2 -->
    <script src="{{asset('assets/plugins/sweetalert2/js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    <!-- Toastr -->
    <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('assets/plugins/summernote/summernote-bs4.min.js')}}"></script> 
    <!-- CodeMirror -->
    <script src="{{asset('assets/plugins/codemirror/codemirror.js')}}"></script>
    <script src="{{asset('assets/plugins/codemirror/mode/css/css.js')}}"></script>
    <script src="{{asset('assets/plugins/codemirror/mode/xml/xml.js')}}"></script>
    <script src="{{asset('assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    @include('sweetalert::alert')
<!-- Page specific script -->
    <script>
        $(function () {
            bsCustomFileInput.init();
        });
    
    </script>
    @yield('js')
    
    </body>
    </html>
    