<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIM KLINIK</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <style>
        .card-footer {
            background-color: transparent;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
              {{-- user account --}}
              <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="fas fa-cog"></i> <span>|</span> {{auth()->user()->nama}}
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer" data-toggle="modal"
                        data-target="#logoutModal"
                        onclick="event.preventDefault();
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
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link text-center">
                {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
                <span class="brand-text font-weight-light "><strong>SIM KLINIK</strong></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->

                        <li class="nav-item ">
                            <a href="{{ route('home') }}" class="nav-link {{request()->is('admin/dashboard*') ? ' active' : ''}}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('rujukan.index') }}" class="nav-link {{request()->is('admin/rujukan*') ? ' active' : ''}}">
                                <i class="nav-icon fas fa-ambulance"></i>
                                <p>
                                    Rujukan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('tempat_rujukan.index') }}" class="nav-link {{request()->is('admin/tempat_rujukan*') ? ' active' : ''}}">
                                <i class=" nav-icon fas fa-house-damage"></i>
                                <p>
                                    Tempat Rujukan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link
                            {{request()->is('admin/obat*') || request()->is('admin/pembelian_obat_suppliers*') || request()->is('admin/kategori_obat*') ||
                            request()->is('admin/resep_obat*') ? ' active' : ''}}

                            ">
                                <i class="nav-icon fas fa-capsules"></i>
                                <p>
                                    Layanan Obat
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('obat.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Obat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pembelian_obat_suppliers.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pembelian Obat Supplier</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('kategori_obat.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kategori Obat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('resep_obat.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Resep Obat</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user_admin.index') }}" class="nav-link {{request()->is('admin/user_admin*') ? ' active' : ''}}">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Admin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user_dokter.index') }}" class="nav-link {{request()->is('admin/user_dokter*') || request()->is('admin/jadwal_dokters*')
                             ? ' active' : ''}}">
                                <i class="nav-icon fas fa-user-md "></i>
                                <p>
                                    Dokter
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('user_dokter.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tambah Dokter</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('jadwal_dokter') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Buat Jadwal Dokter</p>
                                    </a>
                                </li>
                              
                                <li class="nav-item">
                                    <a href="{{ route('dokter.jadwaltelemedicine') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Jadwal Telemedicine</p>
                                    </a>
                                </li>
                            </ul>
                            
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user_pasien.index') }}" class="nav-link {{ request()->is('admin/user_pasien*') ? ' active' : ''}}">
                                <i class="nav-icon fas fa-hospital-user"></i>
                                <p>
                                    Pasien
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{ route('user_apoteker.index') }}" class="nav-link {{ request()->is('admin/user_apoteker*') ? ' active' : ''}}">
                                <i class="nav-icon fas fa-user-nurse"></i>
                                <p>
                                    Apoteker
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('admin/reschedule') }}" class="nav-link {{ request()->is('admin/reschedule*')  ? ' active' : ''}}">
                                <i class="nav-icon fas fa-clock"></i>
                                <p> Reschedule</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('admin.admintransaksitelemedicine.index') }}" class="nav-link {{ request()->is('admin/admintransaksitelemedicine*')  ? ' active' : ''}}">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>
                                    Transaksi Telemedicine
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('admin.reseptelemedicine.index') }}" class="nav-link {{ request()->is('admin/reseptelemedicine*')  ? ' active' : ''}}">
                                <i class="nav-icon fas fa-scroll"></i>
                                <p>
                                    Resep Telemedicine
                                </p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a href="{{ route('spesialis.index') }}" class="nav-link {{request()->is('admin/spesialis*') ? ' active' : ''}}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Spesialis
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
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

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
                            <img class="d-block w-100" src="{{ asset('bantuan/admin/15.jpg') }}" alt="First slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('bantuan/admin/16.jpg') }}" alt="Second slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('bantuan/admin/17.jpg') }}" alt="Third slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('bantuan/admin/18.jpg') }}" alt="Third slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('bantuan/admin/19.jpg') }}" alt="Third slide">
                          </div>
                          <div class="carousel-item">
                            <img class="d-block w-100" src="{{ asset('bantuan/admin/20.jpg') }}" alt="Third slide">
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
        <strong>Copyright &copy; 2014-2021 <a href="https:/adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b>Version</b> 3.2.0
        </div>
      </footer> --}}
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ asset('dist/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ asset('dist/Chart.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/demo.js') }}"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('dist/dashboard3.js') }}"></script> --}}

    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        const date = new Date();
        const d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();

        const Calendar = FullCalendar.Calendar;

        const checkbox = document.getElementById('drop-remove');
        const calendarEl = document.getElementById('calendar');

        const calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',

            //Random default events
            events: [],
            editable: true,
        });

        calendar.render();
    </script>
    {{-- datatables --}}
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

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
            $(function() {
                let table = new DataTable('#example3', {
                    // paging: true,
                    // lengthChange: true,
                    // searching: true,
                    // ordering: true,
                    // info: true,
                    // autoWidth: false,
                    //
                });
            });
    </script>

    @yield('js')
</body>

</html>
