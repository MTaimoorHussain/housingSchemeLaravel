<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Housing Scheme</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href={{asset("public/adminlte/plugins/fontawesome-free/css/all.min.css")}}>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href={{asset("public/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css")}}>
  <!-- adminlte style -->
  <link rel="stylesheet" href={{asset("public/adminlte/dist/css/adminlte.min.css")}}>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <style>
    .modal-header{
      background: #008000;
      color: white;
    }
    #label {
      position: absolute;
      top: 10px;
      left: 13px;
      width: 100%;
      color: #d3d3d3;
      transition: 0.2s all;
      cursor: text;
    }
    .input {
      width: 100%;
      border: 0;
      outline: 0;
      padding: 0.5rem 0;
      border-bottom: 2px solid #d3d3d3;
      box-shadow: none;
      color: #111;
    }
    .input:invalid {
      outline: 0;
      // color: #ff2300;
      //   border-color: #ff2300;
    }
    .input:focus,
    .input:valid {
      border-color: #00dd22;
    }
    .input:focus~#label,
    .input:valid~#label {
      font-size: 14px;
      top: -14px;
      left: 4px;
      color: #00dd22;
    }
    .addButton{
      margin-top:7%;
    }
    .CarryInput{
     margin-top: 4%;
   }
   .paginate_button{
    background: #28a745;
    color: white;
    color: white !important;
  }
</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
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
        <img src={{asset("public/adminlte/dist/img/AdminLTELogo.png")}} alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src={{asset("public/adminlte/dist/img/user2-160x160.jpg")}} class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ucfirst(auth()->user()->name)}}</a>
          </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

             <li class="nav-item">
              <a href="dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt color-gray"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-registered"></i>
                <p>
                  Society Registration
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="society_registration" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Society Registration</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cubes"></i>
                <p>
                  Society Setup
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="allbank" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Banks Listing</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="bankdetail" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Society Banks</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="chargetype" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Charges Listing</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="charge" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Society Charges</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="plotcategory" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Plot Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="plottype" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Plot Type</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="block" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Blocks</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="societylayoutplan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Society layout Plan</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Tender Management
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="tender" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Tender</p>
                  </a>
                </li>
              </ul>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="content">
        <div class="container-fluid">
          @yield('content')
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    <!-- Main Footer -->
  </div>
  <!-- ./wrapper -->
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  {{-- <script src={{asset("public/adminlte/plugins/jquery/jquery.min.js")}}></script> --}}
  <!-- Bootstrap -->
  <script src={{asset("public/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js")}}></script>
  <!-- overlayScrollbars -->
  <script src={{asset("public/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js")}}></script>
  <!-- AdminLTE App -->
  <script src={{asset("public/adminlte/dist/js/adminlte.js")}}></script>
  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src={{asset("public/adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js")}}></script>
  <script src={{asset("public/adminlte/plugins/raphael/raphael.min.js")}}></script>
  <script src={{asset("public/adminlte/plugins/jquery-mapael/jquery.mapael.min.js")}}></script>
  <script src={{asset("public/adminlte/plugins/jquery-mapael/maps/usa_states.min.js")}}></script>
  <!-- ChartJS -->
  <script src={{asset("public/adminlte/plugins/chart.js/Chart.min.js")}}></script>
</body>
</html>