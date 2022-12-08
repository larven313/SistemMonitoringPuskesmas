<!DOCTYPE html>
<html lang="id">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  {{-- <meta http-equiv="refresh" content="3"> refresh page selama 3 detik sekali --}} 
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sistem Monitoring Puskesmas Sukabumi</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('template')}}/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="{{ asset('template')}}/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('template')}}/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('template')}}/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('home')}}/img/logo-puskesmas.png" />

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">  
          <a class="navbar-brand brand-logo" href="{{ url('/') }}"><img src="{{ asset('home') }}/img/banner-logo-puskesmas2.png" alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}"><img src="{{ asset('home') }}/img/banner-logo-puskesmas2.png" alt="logo"/></a>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              {{-- <img src="{{ asset('template')}}/images/faces/face5.jpg" alt="profile"/> --}}
              @if (Auth::user()->avatar == null)
              {{-- <img src="{{ asset('template')}}/images/faces/ic_user.png" alt="profile"/> --}}
              @if (Auth::user()->gender == 'L')
              <img src="https://img.icons8.com/color/48/000000/user.png"/>
              @else
                  <img src="data:image/png;base64,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"/>
              @endif
              
              @else
                {{-- @if (Auth::user()->avatar == )
               <img src="https://img.icons8.com/color/48/000000/circled-user-female-skin-type-4--v1.png"/>
                @endif --}}
              <img src="{{ asset('img')}}/{{ Auth::user()->avatar}}" alt="profile"/>
              @endif
              

              <span class="nav-profile-name">{{ Auth::user()->username}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{route('users.show',Auth::user()->id)}}">
                <i class="mdi mdi-settings text-primary"></i>
                Profile
              </a>
              <form action="{{route('logout')}}" method="post">
              @csrf
              <button class="dropdown-item" type="submit">
                <i class="mdi mdi-logout text-primary"></i>
                Logout
              </button>
            </form>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Beranda</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
              <i class="mdi mdi-chart-areaspline menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          
          @if (Auth::user()->roles == '["USER"]')
          <li class="nav-item ">
            <a class="nav-link " href="{{route('antrian')}}">
              <i class="mdi mdi mdi-book-multiple menu-icon"></i>  
              <span class="menu-title">Data Antrian</span>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link " href="{{route('obat.show',Auth::user()->id)}}">
              <i class="mdi mdi-hospital menu-icon"></i>
              <span class="menu-title">Resep Obat</span>
            </a>
          </li>
          @else

          @if (Auth::user()->roles == '["ADMIN"]')
          {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('dokter') }}">
              <i class="mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Data Dokter</span>
            </a>
          </li> --}}

          {{-- <li class="nav-item">
            <a class="nav-link" href="{{route('poli')}}">
              <i class="mdi mdi mdi-hospital-building menu-icon"></i>
              <span class="menu-title">Data Poli</span>
            </a>
          </li> --}}

          <li class="nav-item">
            <a class="nav-link" href="{{route('users')}}">
              <i class="mdi mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Data Pengguna</span>
            </a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('pegawai') }}">
              <i class="mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Data Pegawai</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{ route('dokter') }}">
              <i class="mdi mdi-account-multiple menu-icon"></i>
              <span class="menu-title">Data Dokter</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('jadwal-dokter')}}">
              <i class="mdi mdi mdi-calendar-clock menu-icon"></i>
              <span class="menu-title">Jadwal Dokter</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="{{route('categories')}}">
              <i class="mdi mdi mdi-book-multiple menu-icon"></i>
              <span class="menu-title">Data Pasien</span>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link " href="{{route('antrian')}}">
              <i class="mdi mdi mdi-book-multiple menu-icon"></i>  

              <span class="menu-title">Data Antrian</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="{{route('poli')}}">
              <i class="mdi mdi mdi-hospital-building menu-icon"></i>
              <span class="menu-title">Data Poli</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="mdi mdi-hospital menu-icon"></i>
              <span class="menu-title">Data Obat</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('obat') }}">Stok Obat</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('suplai') }}">Supplier Obat</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('pemasukan-obat') }}">Pemasukan Obat</a></li>

              </ul>
            </div>
          </li>
          @endif


         

          <li class="nav-item">
            <a class="nav-link" href="{{route('puskesmas')}}">
              <i class="mdi mdi mdi-hospital-building menu-icon"></i>
              <span class="menu-title">Data Puskesmas</span>
            </a>
          </li>



          
          

          @endif
         


         
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
           <div class="row">
            {{-- <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <h2>Selamat Pergi,</h2>
                    <p class="mb-md-0">Di Aplikasi Larabook.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Sales</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="purchases-tab" data-toggle="tab" href="#purchases" role="tab" aria-controls="purchases" aria-selected="false">Purchases</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg mr-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <h5 class="mr-2 mb-0">$577545</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye mr-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total views</small>
                            <h5 class="mr-2 mb-0">9833550</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download mr-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="mr-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="mr-2 mb-0">3497843</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg mr-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download mr-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="mr-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye mr-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total views</small>
                            <h5 class="mr-2 mb-0">9833550</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <h5 class="mr-2 mb-0">$577545</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="mr-2 mb-0">3497843</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="purchases" role="tabpanel" aria-labelledby="purchases-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-calendar-heart icon-lg mr-3 text-primary"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Start date</small>
                            <div class="dropdown">
                              <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h5 class="mb-0 d-inline-block">26 Jul 2018</h5>
                              </a>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">
                                <a class="dropdown-item" href="#">12 Aug 2018</a>
                                <a class="dropdown-item" href="#">22 Sep 2018</a>
                                <a class="dropdown-item" href="#">21 Oct 2018</a>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-currency-usd mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Revenue</small>
                            <h5 class="mr-2 mb-0">$577545</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-eye mr-3 icon-lg text-success"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Total views</small>
                            <h5 class="mr-2 mb-0">9833550</h5>
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-download mr-3 icon-lg text-warning"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Downloads</small>
                            <h5 class="mr-2 mb-0">2233783</h5>
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Flagged</small>
                            <h5 class="mr-2 mb-0">3497843</h5>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
          </div> 
          {{-- <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">  --}}
                
                @yield('konten')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('template')}}/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{ asset('template')}}/vendors/chart.js/Chart.min.js"></script>
  <script src="{{ asset('template')}}/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="{{ asset('template')}}/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('template')}}/js/off-canvas.js"></script>
  <script src="{{ asset('template')}}/js/hoverable-collapse.js"></script>
  <script src="{{ asset('template')}}/js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('template')}}/js/dashboard.js"></script>
  <script src="{{ asset('template')}}/js/data-table.js"></script>
  <script src="{{ asset('template')}}/js/jquery.dataTables.js"></script>
  <script src="{{ asset('template')}}/js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

