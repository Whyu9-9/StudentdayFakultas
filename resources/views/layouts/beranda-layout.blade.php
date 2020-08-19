<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SD - @if(Auth::user()->nama_panggilan == null) Mahasiswa @elseif(Auth::user()->nama_panggilan!=null) {{Auth::user()->nama_panggilan}}@endif</title>
    <meta name="description:" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('/img/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!-- Font-Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('/css/all.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootadmin.min.css') }}">
    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('/css/datatables.min.css') }}">

    @yield('custom_style')
    <style>
        /*--------------------------------------------------------------
        # Footer
        --------------------------------------------------------------*/
        .footer {
            background: #292e33;
            bottom: 0;
            width: 100%;
            color: #fff;
            font-size: 14px;
        }

        .footer a {
            color: #999;
            text-decoration: none;
        }
        body::-webkit-scrollbar {
            width: 0.4em;
        }

        body::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color:#222222;
        }

        body::-webkit-scrollbar-thumb {
            background-color:#666666;
            opacity: 0.6;
            border-radius: 10px;
        }

    </style>

</head>
<body class="bg-light">
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
        <a class="navbar-brand" href="{{ route('beranda-sd.index') }}">Dashboard Mahasiswa</a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->nama }}</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        <a href="/ganti-password" class="dropdown-item">
                            <i class="fa-key fa"></i> Ganti Password
                        </a>
                        <a class="dropdown-item" href="/logout">
                            <i class="fa fa-power-off"></i>
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('user.logout') }}" method="get" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        <div class="sidebar sidebar-dark bg-dark">
            <ul class="list-unstyled">
                <?php
                    $serverdate = date("d-m-Y");
                    if($serverdate == '19-08-2020'){
                        $datecond = 1;
                    }else{
                        $datecond = 0;
                    }
                ?>
                <li class="@yield('active1')"><a href="{{ route('beranda-sd.index') }}"><i class="fa fa-fw fa-home"></i> Beranda</a></li>
                <li class="@yield('activeregistrasi')">
                    <a href="#sm_base" data-toggle="collapse" aria-expanded="false">
                        <i class="fas fa-pencil-alt fa-fw"></i> Registrasi
                    </a>
                    <ul id="sm_base" class="list-unstyled collapse hide">
                        <li class="@yield('active2')"><a href="{{ route('beranda-sd.biodata') }}"><i class="fa fa-fw fa-user"></i> Biodata</a></li>
                        <li class="@yield('active4')"><a href="/prestasis"><i class="fa fa-fw fa-trophy"></i> Prestasi</a></li>
                        <li class="@yield('active5')"><a href="/organisasi"><i class="fa fa-fw fa-building"></i> Organisasi</a></li>
                    </ul>
                </li>
                @if(Auth::user()->lengkap >= 4 && Auth::user()->lengkap != 9)
                    @if ($datecond != 0)
                    <li class="@yield('active6')"><a href="{{ route('beranda-sd.verifikasi') }}"><i class="fas fa-check-circle fa-fw"></i> Verifikasi</a></li>
                    @if(Auth::user()->lengkap == 8)
                    <li class="@yield('active3')"><a href="{{ route('beranda-sd.cetak-berkas') }}"><i class="fa fa-fw fa-print"></i> Unduh Berkas</a></li>
                    <li class="@yield('active9')"><a href="{{ route('beranda-sd-penugasan') }}"><i class="fas fa-fw fa-file-pdf"></i> Penugasan</a></li>
                    @endif
                    @endif
                <!--<li class="@yield('active7')"><a href="{{ route('beranda-sd-resume') }}"><i class="fas fa-fw fa-file-pdf"></i> Resume</a></li>-->
                <li class="@yield('active8')"><a href="{{ route('beranda-sd-qrcode')}}"><i class="fa fa-fw fa-qrcode"></i> QR Code</a></li>
                @endif
            </ul>
        </div>

        <div class="content" style="background-color:#f5f5f5">
            <div class="p-4">
                <!-- Modal -->
                <div class="modal fade" id="modalIklan" tabindex="-1" aria-labelledby="modalIklantitle" aria-hidden="true">
                    <div class="modal-dialog">
                          <div class="modal-content">
                                <div class="modal-header">
                                      <h5 class="modal-title" id="modalIklantitle"></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                </div>
                            <div class="modal-body">
                                <p id="modalIklantext"></p>
                                <img src="" alt="" id="modalIklanimage">
                            </div>
                            <div class="modal-footer">
                                <div class="" id="modalIklanform">

                                </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                          </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <div class="py-2 footer text-center">
        &copy; 2018 <a href="/"><strong>SMFT</strong></a>. All Rights Reserved
    </div>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/js/popper.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/bootadmin.min.js') }}"></script>
    <script src="{{ asset('/js/datatables.min.js') }}"></script>
    <script src="{{ asset('/js/all.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
        /*Script Umum*/
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function getIklan(){
                $.ajax({
                    url: '/get/iklan/pembelianBaju',
                    type: "get"
                }).done(function(hasil){
                    // alert(hasil);
                    var x = Math.floor((Math.random() * 10) + 1);
                    var y = x % 2;
                    if(hasil == 0){
                        if(y == 0){
                            $('#alert-iklan').css("display", "block");
                            $('#alert-iklan').html('Text Iklan Aatau apa aja');
                        }else{
                            $('#alert-iklan').css("display", "none");
                        }
                    }else{
                        $('#alert-iklan').css("display", "none");
                    }
                });
            }

            getIklan();
        });
    </script>
    @yield('custom_javascript')
</body>
</html>
