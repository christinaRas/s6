<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
</head>
<body>

  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
  @endif

  @if(session()->has('error'))
  <div class="alert alert-danger">
      <ul>
          <li>{{session('error')}}</li>
      </ul>
  </div>
  @endif

<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <p><img src="{{ asset('assets/images/logo.png') }}" alt=""></p>
                ULTIMATE TEAM RACE 
              </div>
              <h6 class="font-weight-light">Se connecter pour continuer.</h6>
              <form class="pt-3" action="{{ route('loginpost') }}" method="post">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Team name" name="login">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                    <button  class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">Se connecter</button>
                </div>
                {{-- <div class="text-center mt-4 font-weight-light">
                  Inscription  <a href="{{ route('inscri') }}" class="text-primary">Créer</a>
                </div> --}}
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->

    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
      <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
      <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
      <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
      <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>
      <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
      <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
      <script src="{{ asset('assets/js/template.js') }}"></script>
      <script src="{{ asset('assets/js/settings.js') }}"></script>
      <script src="{{ asset('assets/js/todolist.js') }}"></script>
      <script src="{{ asset('assets/js/dashboard.js') }}"></script>
      <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
</div>
</body>
</html>