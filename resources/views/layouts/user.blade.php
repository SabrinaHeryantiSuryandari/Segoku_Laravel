
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sistem Informasi Penjualan</title>
        <!-- Favicon-->
        {{-- <link rel="icon" type="image/x-icon" href="{{ asset('template2/assets/favicon.ico')}}" /> --}}
        <!-- Font Awesome icons (free version)-->
        {{-- <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script> --}}
        <link rel="stylesheet" href="https://code.jquery.com/jquery-3.7.0.js">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="{{ asset('template1/vendors/ti-icons/css/themify-icons.css')}}">
        <link rel="stylesheet" href="{{ asset('template1/vendors/mdi/css/materialdesignicons.min.css')}}">
  <link rel="stylesheet" href="{{ asset('template1/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
        <link rel="stylesheet" type="{{ asset('template1/text/css" href="js/select.dataTables.min.css')}}">
        <link rel="stylesheet" href="{{ asset('template1/css/vertical-layout-light/style.css')}}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        {{-- <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> --}}
        <!-- Simple line icons-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('template2/css/styles.css')}}" rel="stylesheet" />
        <link rel="shortcut icon" href="img/segoku.png" />
    </head>
    <body id="page-top" style="background-color: #f8f9fc;">
    {{-- <body id="page-top" style="background-color: #f8f9fc;"> --}}
        <!-- Navigation-->
        {{-- <div class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top"> --}}
            {{-- <div class="row" style="background-color: #fce4ab"> --}}
        {{-- <div class="col-lg-12 col-12 p-0 fixed-top d-flex flex-row"> --}}
            <div class="row" style="background-color: #ffffff;">
                <div class="px-5 my-3 algine-text-center" >
                    {{-- <div class="align-text-center"  >style="background: #FCE4AC"--}}
                    <a class="navbar-brand" href="#" >
                        <img src="img/segoku.png" alt="Logo" width="50" height="50" class="align-text-center">
                        {{-- <img src="img/segoku.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top align-text-center"> --}}
                        SEGOKU CATERING SURABAYA
                    </a>
                </div>
                {{-- <div class="center">
                    <a class="navbar-brand" href="#"><img src="img/segoku.png" alt="Logo" width="50" height="50" class="d-inline-block align-text-top"></a>
                    <a class="navbar-brand" href="#page-top">Start Bootstrap</a>
                    </div> --}}
                <!--profile-->
            </div>
        {{-- </div> --}}

        <a class="menu-toggle rounded" href="#"><i class="fas fa-bars"></i></a>
        <nav id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand nav-item nav-profile dropdown">
                    @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    @else
                        {{-- <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown"> --}}
                        {{-- <img class="img-profile rounded-circle" src="{{ asset('template/img/undraw_profile.svg')}}"> --}}
                        <img src="{{ asset('template1/images/faces/face28.jpg')}}" alt="profile" width="50" height="50" class="img-fluid rounded-circle" />
                        <span class="mr-2 d-none d-lg-inline small" style="color: white">{{ Auth::user()->name }}</span>
                        </a>      
                    @endguest
                </li>
                {{-- <li class="sidebar-brand"><a href="#page-top">Start Bootstrap</a></li> --}}
                <li class="sidebar-nav-item"><a href="/user">Home</a></li>
                <li class="sidebar-nav-item"><a href="/about">About</a></li>
                <li class="sidebar-nav-item"><a href="/pesananuser">Pesanan Saya</a></li>
                <li class="sidebar-nav-item"><a href="/pembayaranuser">Pembayaran</a></li>
                <li class="sidebar-nav-item"><a href="/contact">Contact</a></li>
                <!-- {{-- Logout --}} -->
                <li class="sidebar-nav-item">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                      {{-- <i class="ti-power-off text-primary"></i> --}}
                      {{ __('Logout') }}
                    </a>
        
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <div class="row text-center">
            <div class="row px-5 my-3" >
                <div class="col-sm-3 img-fluid rounded-circle" >
                    <a href="/pesananuser" class="btn btn">
                        <h5 class="card-title"><i class="fa-regular fa-file-lines" style="font-size:36px; color: #4c4b48;"></i></h5>
                        <p class="card-text">Pesanan</p>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="/pembayaranuser" class="btn ">
                        <h5 class="card-title"><i class="fa-solid fa-dollar-sign" style="font-size:36px; color: #4c4b48;"></i></h5>
                        <p class="card-text">Pembayaran </p>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="/contact" class="btn ">
                        <h5 class="card-title"><i class="fa-solid fa-question" style="font-size:36px; color: #4c4b48;"></i></h5>
                        <p class="card-text">Bantuan </p>
                    </a>
                </div>
                <div class="col-sm-3">
                    {{-- <div class="card">
                        <div class="card-body"> --}}
                            <a href="/userakun" class="btn ">
                                <h5 class="card-title"><i class="fa-solid fa-user" style="font-size:36px; color: #4c4b48;"></i></h5>
                                <p class="card-text">Akun </p>
                            </a>
                        {{-- </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Header-->
        {{-- <div class="main-panel"> --}}
            {{-- <div class="content-wrapper"> --}}
                @yield('content')
            {{-- </div> --}}
                <!-- Map-->
                {{-- <div class="map" id="contact">
                    <!-- <iframe src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A&amp;output=embed"></iframe> -->>
                    <iframe src="https://maps.google.co.id/maps/place/Segoku+GKM/@-7.3320271,112.689361,21z/data=!4m6!3m5!1s0x2dd7fd7aedf61531:0xe994a5dc4682acb7!8m2!3d-7.3321438!4d112.6892637!16s%2Fg%2F11h_z80l58?entry=ttu"></iframe>
                    <br />
                    <!---- <small><a href="https://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;aq=0&amp;oq=twitter&amp;sll=28.659344,-81.187888&amp;sspn=0.128789,0.264187&amp;ie=UTF8&amp;hq=Twitter,+Inc.,+Market+Street,+San+Francisco,+CA&amp;t=m&amp;z=15&amp;iwloc=A"></a></small> -->>
                    <small><a href="https://www.google.co.id/maps/place/Segoku+GKM/@-7.3320271,112.689361,21z/data=!4m6!3m5!1s0x2dd7fd7aedf61531:0xe994a5dc4682acb7!8m2!3d-7.3321438!4d112.6892637!16s%2Fg%2F11h_z80l58?entry=ttu"></a></small>
                </div> --}}
            <!-- Footer-->
            <footer class="footer text-center">
                <div class="container px-4 px-lg-5">
                    <ul class="list-inline mb-5">
                        <!--Facebook-->
                        <li class="list-inline-item">
                            <a class="social-link rounded-circle text-white mr-3" href="https://m.facebook.com/segokucatering?paipv=0&eav=AfaXIus3fkuxIiJS-vOYGXc2HiEXLjO2NXNWs9bADubJWmdd3geJhQdKi1JrYgQjlGY"><i class="icon-social-facebook"></i></a>
                        </li>
                        <!--Instagram-->
                        <li class="list-inline-item">
                            <a class="social-link rounded-circle text-white mr-3" href="https://instagram.com/segokusby?igshid=MzRlODBiNWFlZA=="><i class="icon-social-instagram"></i></a>
                        </li>
                        <!--Whatsapp-->
                        <li class="list-inline-item">
                            {{-- <a class="social-link rounded-circle text-white mr-3" href="Https://wa.me/62838-3441-7766"><i class="fa fa-whatsapp"></i></a> --}}
                            <a class="social-link rounded-circle text-white" href="Https://wa.me/62838-3441-7766"><i class="mdi mdi-whatsapp" style="height: auto"></i></a>
                        </li>
                    </ul>
                    <p class="text-muted small mb-0">Jl. Graha Kebraon Mas Balas Klumprik 2, Balas Klumprik, Kec. Wiyung, Surabaya, Jawa Timur 60222</p>
                </div>
            </footer>
        {{-- </div> --}}
        <!-- Scroll to Top Button-->
        {{-- <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a> --}}
        <!-- Bootstrap core JS-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('template2/js/scripts.js')}}"></script>
        @yield('js')
        <script src="{{ asset('template1/vendors/chart.js/Chart.min.js')}}"></script>
        <script src="{{ asset('template1/vendors/datatables.net/jquery.dataTables.js')}}"></script>
        <script src="{{ asset('template1/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
        <script src="{{ asset('template1/js/dataTables.select.min.js')}}"></script>
        
        <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        {{-- <script>
            $(document).ready(function() {
              // DataTable initialisation
              $('#data2').DataTable({
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
        </script> --}}
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
        {{-- <script>
            new DataTable('#data1');
        </script> --}}
    </body>
</html>