<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pasien Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('fontawesome/css/all.min.css')}}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">
  {{-- <link rel="stylesheet" href="sweetalert2.min.css">   --}}

  
  <style>
    .card-footer {
        background-color:transparent;
    }

    </style>
</head>
<body>
    
      <!-- Navbar -->
      <nav class=" navbar ">
        <!-- Left navbar links -->
        
        <h4>SIM KLINIK</h4>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">

          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-cog"></i> <span>|</span> {{auth()->user()->nama}}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class="dropdown-divider"></div>
              <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer" data-toggle="modal"
                            data-target="#logoutModal" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
            </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      {{-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
       
        <a href="{{route('home')}}" class="brand-link text-center">
         
          <span class="brand-text font-weight-light ">SIM KLINIK</span>
        </a>

        
        <div class="sidebar">
          
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">              

                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link {{ request()->is('pasien/dashboard*') ? ' active' : ''}}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p> 
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('berobat')}}" class="nav-link {{ request()->is('pasien/berobat*') ? ' active' : ''}}">
                    <i class="nav-icon fas fa-clinic-medical"></i>
                    <p>
                        Pendaftaran Berobat
                    </p>
                    </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('pasien.telemedicine.index')}}" class="nav-link {{ request()->is('pasien/telemedicine*') ? ' active' : ''}}">
                  <i class="nav-icon fas fa-stethoscope"></i>
                  <p>                    
                        Telemedicine
                  </p>
                  </a>
              </li>

              <li class="nav-item">
                <a href="{{route('pasien.transactiontelemedicine.index')}}" class="nav-link {{ request()->is('pasien/transactiontelemedicine*') ? ' active' : ''}}">
                <i class="nav-icon fas fa-money-bill"></i>
                <p>
                  
                      Transaksi 
                </p>
                </a>
            </li>

            <li class="nav-item">
              <a href="{{route('pasien.reseptelemedicine.index')}}" class="nav-link {{ request()->is('pasien/reseptelemedicine*') ? ' active' : ''}}">
                <i class="nav-icon fas fa-scroll"></i>
              <p>
                
                    Resep Telemedicine 
              </p>
              </a>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link" data-toggle="modal" data-target="#bantuans">
                <i class="nav-icon fas fa-info-circle" ></i>
                <p>
                    Bantuan
                </p>
                
            </a>
          </li>         
            </ul>
          </nav>
          
        </div>
       
      </aside> --}}

      <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Appointment</span>
                            <a href="{{route('berobat')}}" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Buat Janji Temu</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"> <i class="nav-icon fas fa-stethoscope"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Telemedicine</span>
                            <a href="{{route('pasien.telemedicine.index')}}" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Buat Janji Temu</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon">  <i class="nav-icon fas fa-money-bill"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-number">Transaksi</span>
                            <a href="{{route('pasien.transactiontelemedicine.index')}}" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Buat Janji Temu</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-warning">
                      <span class="info-box-icon"> <i class="nav-icon fas fa-scroll"></i></span>
                      <div class="info-box-content">
                          <span class="info-box-number">Resep Telemdicine</span>
                          <a href="{{route('pasien.reseptelemedicine.index')}}" type="button" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Buat Janji Temu</a>
                      </div>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4 col-sm-6 col-12">
                  <div class="info-box bg-warning">
                      <span class="info-box-icon">  <i class="nav-icon fas fa-info-circle" ></i></span>
                      <div class="info-box-content"> 
                          <span class="info-box-number">Bantuan</span>
                          <a href="#" data-toggle="modal" data-target="#bantuans" type="button" class="btn btn-sm btn-default">Bantuan</a>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </div>

    <hr>

       {{-- modal bantuan --}}                                
       <div class="modal fade" id="bantuans" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Bantuan Penggunaan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('bantuan/pasien/1.jpg') }}" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('bantuan/pasien/2.jpg') }}" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('bantuan/pasien/3.jpg') }}" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('bantuan/pasien/4.jpg') }}" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('bantuan/pasien/5.jpg') }}" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('bantuan/pasien/6.jpg') }}" alt="Third slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('bantuan/pasien/7.jpg') }}" alt="Third slide">
                      </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
            </div>
          
        </div>
        </div>
    </div>



    {{-- end of modal bantuan --}} 
      @yield('content')
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      {{-- <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
        </div>
      </footer> --}}
    
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    

    <!-- jQuery -->
    <script src="{{asset('jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('dist/adminlte.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{asset('dist/Chart.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('dist/demo.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('dist/dashboard3.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    
    @yield('js')
    <script>
     
      $(function() {
          let table = new DataTable('#example1', {
              paging: true,
              lengthChange: true,
              searching: true,
              ordering: true,
              info: true,
              autoWidth: false,
              // 
          });
      });
      $(function() {
         let table = new DataTable('#example2', {
             paging: true,
             lengthChange: true,
             searching: true,
             ordering: true,
             info: true,
             autoWidth: false,
             // 
         });
     });
</script>
    </body>
    </html>
