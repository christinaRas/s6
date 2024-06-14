<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Course</title>

    <link rel="stylesheet" href="{{ asset('admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />

</head>
<body>
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <img width="70px" src="{{ asset('admin/images/logo.png') }}" alt="">
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                <i class="icon-ellipsis"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{route('logout')}}">
                  <i class="ti-power-off text-primary"></i>
                    Logout
                </a>
                <a class="dropdown-item" href="{{ route('reset-tables') }}">
                    reset table
                </a>
                <a class="dropdown-item" href="{{ route('generateCategorie') }}">
                  Generer Categorie
              </a>
              </div>
            </li>
          </ul>
        </div>
      </nav>


      <div class="container-fluid page-body-wrapper">
          <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                  <i class="icon-grid menu-icon"></i>
                  <span class="menu-title">Dashboard</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
                  <i class="icon-columns menu-icon"></i>
                  <span class="menu-title">Entrer</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="form-elements">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('listeEtapeAdmin') }}">Courses</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#liste" aria-expanded="false" aria-controls="liste">
                  <i class="icon-columns menu-icon"></i>
                  <span class="menu-title">Liste</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="liste">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('listeEtapeAdminTsotra')}}">Etape</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#classement" aria-expanded="false" aria-controls="classement">
                  <i class="icon-columns menu-icon"></i>
                  <span class="menu-title">Classement</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="classement">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('classementEtape') }}  ">Par etape</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('classementTotal') }}">Par equipe</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('adminClassementCategorie') }}">Par categorie</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#import" aria-expanded="false" aria-controls="import">
                  <i class="icon-columns menu-icon"></i>
                  <span class="menu-title">Import</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="import">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('importEtape') }}  ">Etapes / resultats</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('importPoint') }}  ">Points</a></li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#penalite" aria-expanded="false" aria-controls="penalite">
                  <i class="icon-columns menu-icon"></i>
                  <span class="menu-title">Penalite</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="penalite">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('penalite') }}  ">Liste Penalite</a></li>
                  </ul>
                </div>
              </li>
            </ul>
          </nav>
          
        
        <div class="main-panel">        
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>

      </div>

      

      <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
      <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
      <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
      <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
      <script src="{{ asset('admin/js/dataTables.select.min.js') }}"></script>
      <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
      <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
      <script src="{{ asset('admin/js/template.js') }}"></script>
      <script src="{{ asset('admin/js/settings.js') }}"></script>
      <script src="{{ asset('admin/js/todolist.js') }}"></script>
      <script src="{{ asset('admin/js/dashboard.js') }}"></script>
      <script src="{{ asset('admin/js/Chart.roundedBarCharts.js') }}"></script>
      <script src="{{ asset('admin/js/file-upload.js') }}"></script>
      <script src="{{ asset('admin/js/chart.js') }}"></script>
      
</body>
</html>