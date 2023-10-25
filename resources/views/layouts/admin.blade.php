
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  {{-- <title>Admin segoku</title> --}}

  <title>@yield('title')</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('template1/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{ asset('template1/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{ asset('template1/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('template1/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{ asset('template1/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" type="{{ asset('template1/text/css" href="js/select.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{ asset('template1/vendors/mdi/css/materialdesignicons.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('template1/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="img/segoku.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="img/logoSegoku.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="img/segoku.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <!--Profile-->
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                @guest
                @if (Route::has('login'))
                <a class="nav-link dropdown-toggle" href="{{ route('login') }}" data-toggle="dropdown" id="profileDropdown">
                    <img src="images/faces/face28.jpg" alt="profile"/>{{ __('Login') }}
                </a>
                @endif
      
                @else
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    {{-- <img class="img-profile rounded-circle" src="{{ asset('template/img/undraw_profile.svg')}}"> --}}
                    <img src="img/segoku.png" alt="profile" />
                    <span class="mr-2 d-none d-lg-inline small">{{ Auth::user()->name }}</span>
                </a>
    
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                  {{-- <a class="dropdown-item">
                      <i class="ti-settings text-primary"></i>
                      Settings
                  </a> --}}
                  <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="ti-power-off text-primary"></i>
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
                </div>
                @endguest
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      {{-- <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div> --}}
      {{-- <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div> --}}
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <!--Dashboard-->
            <li class="nav-item">
                <a class="nav-link" href="/admin">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <!--Menu-->
            <li class="nav-item">
                <a class="nav-link" href="/menu">
                <i class="mdi mdi-folder-multiple-outline menu-icon"></i>
                <span class="menu-title">Data Menu</span>
                </a>
            </li>
            <!--Pesanan-->
            <li class="nav-item">
                <a class="nav-link" href="/pesanan">
                <i class="mdi mdi-folder-multiple-outline menu-icon"></i>
                <span class="menu-title">Data Pesanan</span>
                </a>
            </li>
            <!--Laporan-->
            <li class="nav-item">
                <a class="nav-link" href="/laporan">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Cetak Laporan</span>
                </a>
            </li>
            <!-- Heading -->
            <div class="sidebar-heading text-black-50">
              Prediksi Penjualan 
            </div>
            <!--Laba Penjualan-->
            <li class="nav-item">
                <a class="nav-link" href="/penjualanbulanan">
                <i class="menu-icon mdi mdi-server"></i>
                <span class="menu-title">Penjualan</span>
                </a>
            </li>
            <!--Prediksi  Penjualan-->
            <li class="nav-item">
                <a class="nav-link" href="/prediksipenjualan">
                    
                <i class="menu-icon"><img src="img/prediksi.png" alt="icon" width="20px" height="20px"></i>
                <span class="menu-title">Prediksi Penjualan</span>
                </a>
            </li>
            <!-- Heading -->
            <div class="sidebar-heading text-black-50">
              Prediksi Bulanan 
            </div>
            <!--Laba Bulanan-->
            <li class="nav-item">
                <a class="nav-link" href="/lababulanan">
                <i class="menu-icon mdi mdi-server"></i>
                <span class="menu-title">Laba Bulanan</span>
                </a>
            </li>
            <!--Prediksi Laba-->
            <li class="nav-item">
                <a class="nav-link" href="/prediksilaba">
                    
                <i class="menu-icon"><img src="img/prediksi.png" alt="icon" width="20px" height="20px"></i>
                <span class="menu-title">Prediksi Laba</span>
                </a>
            </li>
            <!--icon-->
            {{-- <li class="nav-item">
                <a class="nav-link" href="/icon">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Icon</span>
                </a>
            </li> --}}
            
            <!-- Heading -->
            <div class="sidebar-heading text-black-50">
                Pengaturan
            </div>
            
            <!--icon-->
            <li class="nav-item">
                <a class="nav-link" href="/datauser">
                {{-- <i class="icon-paper menu-icon"></i> --}}
                <i class="menu-icon mdi mdi-account-card-details"></i>
                <span class="menu-title">User</span>
                </a>
            </li>
            {{-- <!--menu-arrow-Elements-->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">UI Elements</span>
                <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                    <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li>
                </ul>
                </div>
            </li> --}}
        </ul>
    </nav>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome {{ Auth::user()->name }}</h3>
                <h6 class="font-weight-normal mb-0">Selamat Datang di Sistem Informasi Segoku Catering Surabaya</span></h6>
              </div>
              <!--tanggal-->
              <div class="col-12 col-xl-4">
                <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    {{-- <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> --}}
                    <button class="btn btn-sm btn-light bg-white " type="button" aria-haspopup="true" aria-expanded="true">
                      <i class="mdi mdi-calendar"></i> {{ date('l, d F Y')}}
                    </button>
                    {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">January - March</a>
                      <a class="dropdown-item" href="#">March - June</a>
                      <a class="dropdown-item" href="#">June - August</a>
                      <a class="dropdown-item" href="#">August - November</a>
                    </div> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
            {{-- <div class="row">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">@yield('judul')</h1>
                </div>
            </div> --}}
                
      @yield('content')
            {{-- <div>
                <div class="row">
                </div>
                <div class="row">
                </div>
                <div class="row">
                </div>
                <div class="row">
                </div>
                <div class="row">
                </div>
                <div class="row">
                </div>
            </div> --}}
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        {{-- <!-- footer -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></span> 
          </div>
        </footer>  --}}
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('template1/vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('template1/vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{ asset('template1/vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{ asset('template1/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{ asset('template1/js/dataTables.select.min.js')}}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('template1/js/off-canvas.js')}}"></script>
  <script src="{{ asset('template1/js/hoverable-collapse.js')}}"></script>
  <script src="{{ asset('template1/js/template.js')}}"></script>
  <script src="{{ asset('template1/js/settings.js')}}"></script>
  <script src="{{ asset('template1/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('template1/js/dashboard.js')}}"></script>
  <script src="{{ asset('template1/js/Chart.roundedBarCharts.js')}}"></script>
  <!-- End custom js for this page-->
  @yield('js')
  {{-- <script src="https://code.highcharts.com/highcharts.js"></script> --}}
  <script>
    $(document).ready(function() {
      // DataTable initialisation
      $('#data1').DataTable({
        "paging": true,
        "autoWidth": true,
        "columnDefs": [{
          "targets": 3,
          "render": function(data, type, full, meta) {
            var cellText = $(data).text(); //Stripping html tags !!!
            if (type === 'display' && (cellText == "Done" || data == 'Done')) {
              var rowIndex = meta.row + 1;
              var colIndex = meta.col + 1;
              $('#example tbody tr:nth-child(' + rowIndex + ')').addClass('lightRed');
              $('#example tbody tr:nth-child(' + rowIndex + ') td:nth-child(' + colIndex + ')').addClass('red');
              return data;
            } else {
              return data;
            }
          }
        }]
      });
    });
  </script>
</body>

</html>

