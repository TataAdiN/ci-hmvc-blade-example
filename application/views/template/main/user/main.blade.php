<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{$title}}</title>
  <link rel="stylesheet" href="{{base_url('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{base_url('assets/dist/css/adminlte.min.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  @yield('scripts-css')
  <!-- PANGGIL UNTUK INJEK CSS KE TEMPAT INI -->
</head>

<body class="hold-transition text-sm layout-top-nav">
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
        <a href="index3.html" class="navbar-brand">
          <img src="{{base_url('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav">
            @include('template/menu/user/menu')
            <!-- INJEK TEMPLATE MENU KESINI -->
          </ul>
          <form class="form-inline ml-0 ml-md-3">
          </form>
        </div>
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-th-large"></i></a>
          </li>
        </ul>
      </div>
    </nav>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark"> {{$title}}</h1>
            </div>
          </div>
        </div>
      </div>
      <div class="content">
        <div class="container">
          @yield('content')
          <!-- PANGGIL UNTUK INJEK CONTENT KE TEMPAT INI -->
        </div>
      </div>
    </div>

    <aside class="control-sidebar control-sidebar-dark">
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <footer class="main-footer">
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <script src="{{base_url('assets/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{base_url('assets/dist/js/adminlte.min.js')}}"></script>
  @yield('scripts-js')
  
</body>

</html>