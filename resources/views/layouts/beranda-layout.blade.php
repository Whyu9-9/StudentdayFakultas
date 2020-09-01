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

                    if($serverdate == '29-08-2020'){

                        $datecond = 1;

                    }else{

                        $datecond = 0;

                    }

                ?>
                @if(Auth::user()->mahasiswa_baru<3)
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

                    <li class="@yield('activepengenalan')">

                        <a href="#base" data-toggle="collapse" aria-expanded="false">

                            <i class="far fa-address-card fa-fw"></i> Video Pengenalan

                        </a>

                        

                        <ul id="base" class="list-unstyled collapse hide">

                            <li class="@yield('active10')"><a href="/beranda-sd-lembaga"><i class="fa fa-fw fa-user"></i> Lembaga</a></li>

                            <li class="@yield('active11')"><a href="/beranda-sd-himpunan"><i class="fa fa-fw fa-user"></i> Program Studi</a></li>

                            <li class="@yield('active12')"><a href="/beranda-sd-kelompokstudi"><i class="fa fa-fw fa-building"></i> Kelompok Studi</a></li>

                        </ul>

                    </li>

                    <li class="@yield('active9')"><a href="{{ route('beranda-sd-penugasan') }}"><i class="fas fa-fw fa-file-pdf"></i> Penugasan</a></li>
                    @endif

                    @endif

                <!--<li class="@yield('active7')"><a href="{{ route('beranda-sd-resume') }}"><i class="fas fa-fw fa-file-pdf"></i> Resume</a></li>-->

                <li class="@yield('active8')"><a href="{{ route('beranda-sd-qrcode')}}"><i class="fa fa-fw fa-qrcode"></i> QR Code</a></li>

                @endif
            @elseif(Auth::user()->mahasiswa_baru>2)
            <li class="@yield('active1')"><a href="{{ route('beranda-sd.index') }}"><i class="fa fa-fw fa-home"></i> Beranda</a></li>

                <li class="@yield('activeregistrasi')">

                    <a href="#sm_base" data-toggle="collapse" aria-expanded="false">

                        <i class="fas fa-pencil-alt fa-fw"></i> Pendaftaran

                    </a>

                    <ul id="sm_base" class="list-unstyled collapse hide">

                        <li class="@yield('active2')"><a href="{{ route('beranda-sd.biodata') }}"><i class="fa fa-fw fa-user"></i> Biodata</a></li>

                        <li class="@yield('active4')"><a href="/prestasis"><i class="fa fa-fw fa-trophy"></i> Prestasi</a></li>

                        <li class="@yield('active5')"><a href="/organisasi"><i class="fa fa-fw fa-building"></i> Organisasi</a></li>

                    </ul>

                </li>

                @if(Auth::user()->lengkap >= 4 && Auth::user()->lengkap != 9)

                    @if(Auth::user()->lengkap == 8)

                    <li class="@yield('active3')"><a href="{{ route('beranda-sd.cetak-berkas') }}"><i class="fa fa-fw fa-print"></i> Unduh Berkas</a></li>

                    <li class="@yield('activepengenalan')">

                        <a href="#base" data-toggle="collapse" aria-expanded="false">

                            <i class="far fa-address-card fa-fw"></i> Video Pengenalan

                        </a>

                        

                        <ul id="base" class="list-unstyled collapse hide">

                            <li class="@yield('active10')"><a href="/beranda-sd-lembaga"><i class="fa fa-fw fa-user"></i> Lembaga</a></li>

                            <li class="@yield('active11')"><a href="/beranda-sd-himpunan"><i class="fa fa-fw fa-user"></i> Program Studi</a></li>

                            <li class="@yield('active12')"><a href="/beranda-sd-kelompokstudi"><i class="fa fa-fw fa-building"></i> Kelompok Studi</a></li>

                        </ul>

                    </li>

                    <li class="@yield('active9')"><a href="{{ route('beranda-sd-penugasan') }}"><i class="fas fa-fw fa-file-pdf"></i> Penugasan</a></li>

                    @endif

                <!--<li class="@yield('active7')"><a href="{{ route('beranda-sd-resume') }}"><i class="fas fa-fw fa-file-pdf"></i> Resume</a></li>-->
                @if(Auth::user()->lengkap == 8)
                    <li class="@yield('active8')"><a href="{{ route('beranda-sd-qrcode')}}"><i class="fa fa-fw fa-qrcode"></i> QR Code</a></li>
                @endif
                @endif
            @endif
            </ul>

        </div>



        <div class="content" style="background-color:#f5f5f5">

            <div class="p-4">

                @if (session('failedIklan'))

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">

                        <i class="text-danger fas fa-check mr-1"></i> {{session('failedIklan')}}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>

                @elseif (session('successIklan'))

                    <div class="alert alert-success alert-dismissible fade show" role="alert">

                        <i class="text-success fas fa-check mr-1"></i> {{session('successIklan')}}

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">

                            <span aria-hidden="true">&times;</span>

                        </button>

                    </div>

                @endif

                <!-- Modal -->

                <div class="modal" id="modalIklan" tabindex="-1" aria-labelledby="modalIklantitle" aria-hidden="false">

                    <div class="modal-dialog">

                          <div class="modal-content">

                                <div class="modal-header">

                                      <h5 class="modal-title" id="modalIklantitle"></h5>

                                      <img style="width: auto ;max-width: 100% ;height: auto ; display: block;margin-left: auto;margin-right: auto;" id="iklanpict" src=" " placeholder=" ">

                                      <button id="btn-close-iklan" type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none">

                                          <span aria-hidden="true">&times;</span>

                                      </button>

                                </div>

                            <div class="modal-body">

                                <p id="modalIklantext"></p>

                                <img src="" alt="" id="modalIklanimage" style="width: 100%;">

                            </div>

                            <div class="modal-footer">

                                <div style="width: 100%;" id="modalIklanform">



                                </div>

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



            $('#modalIklan #btn-close-iklan').on('click', function(){

                $('#modalIklan #modalIklantitle').html('');

                $('#modalIklan #iklanpict').attr('src', '');

                $('#modalIklan #modalIklantext').html('');

                $('#modalIklan #modalIklanimage').attr('src', '');

                $('#modalIklan #modalIklanform').html('');

                $('#modalIklan #btn-close-iklan').hide();



                window.setTimeout(function() {

                  // console.log('first 10 secs');

                    getPembelianBaju();

                }, 30000);

            })



            function getPembelianBaju(){

                var check = $('#modalIklan').hasClass('show');



                $("#modalIklan").modal({

                    backdrop: 'static',

                    keyboard: false

                });



                if(!check){

                    $.ajax({

                      url: '/get/iklan/pembelianBaju',

                      type: "get"

                    }).done(function(hasil){

                      // alert(hasil);

                      //var y = x % 2;

                      var csrf = $('meta[name="csrf-token"]').attr('content');

                      var formGranat = '<form action="/add/data/pembeli" method="post"><input type="hidden" class="form-control" name="tipe" value="granat"><input name="_token" value="'+csrf+'" type="hidden"><p><strong>Form</strong></p><div class="form-row"><div class="form-group col-md-4"><label for="nama">Nama</label><input type="text" class="form-control" id="nama" name="nama"></div><div class="form-group col-md-4"><label for="nim">NIM</label><input type="text" class="form-control" id="nim" name="nim"></div><div class="form-group col-md-4"><label for="telepon">No Telepon</label><input type="text" class="form-control" id="telepon" name="telepon"></div></div><div class="col-12 px-0"><button type="submit" class="btn btn-success col-12"><i class="fa fa-save"></i> Simpan Data</button></div></form>'



                      if(hasil == 0){

                      var x = Math.floor((Math.random() * 5) + 1);

                        if(x == 1){

                          $('#modalIklan #modalIklantitle').html('Bursa SMFT 2020');

                          $('#modalIklan #iklanpict').attr('src', '{{ asset('/img/null.png') }} ');

                          $('#modalIklan #modalIklantext').html(' ');

                          $('#modalIklan #modalIklanimage').attr('src', '{{ asset('/img/bursa.jpg') }}');

                          $('#modalIklan').modal('show');

                        }else{

                          $('#modalIklan #modalIklantitle').html(' ');

                          $('#modalIklan #iklanpict').attr('src', '{{ asset('/img/granat2020.png') }}');

                          $('#modalIklan #modalIklantext').html('<strong>GrAnaT 2020</strong> <br> Open Pre-Order Baju Identitas Teknik “GrAnaT Edition” Design by Andre Yoga<br><strong>HARGA KHUSUS UNTUK MAHASISWA BARU IDR 135.000</strong><br>DP IDR 100.000<br>Pelunasan Dapat Dilakukan Pada Saat Pengambilan Baju<br>Stock Terbatas!!!<br><strong>PEMESANAN DAPAT DILAKUKAN MELALUI WEB INI DENGAN MENGISI FORM DI BAWAH</strong><br>Bukti Transfer dikirim ke CP via WhatsApp Yogi (082236302253), atau melalui korti jurusan masing-masing.<br>Batas Pemesanan: <br> <strong>PO 1 24 Agustus – 3 September 2020<br>PO 2 Dimulai Tanggal 4 September 2020</strong> DENGAN HARGA NORMAL.<br>HIDUP TEKNIK !!!<br><strong>#GrAnaT2020</strong><br><strong>#GandaraGardapati</strong>');

                          $('#modalIklan #modalIklanimage').attr('src', '{{ asset('/img/postergranat.jpg') }}');

                          $('#modalIklan #modalIklanform').html(formGranat);

                          $('#modalIklan').modal('show');

                        }

                      }else if(hasil == 1){

                      var x = Math.floor((Math.random() * 8) + 1);

                        if(x == 1){

                          $('#modalIklan #modalIklantitle').html(' ');

                          $('#modalIklan #iklanpict').attr('src', '{{ asset('/img/granat2020.png') }}');

                          $('#modalIklan #modalIklantext').html('<strong>GrAnaT 2020</strong> <br> Open Pre-Order Baju Identitas Teknik “GrAnaT Edition” Design by Andre Yoga<br><strong>HARGA KHUSUS UNTUK MAHASISWA BARU IDR 135.000</strong><br>DP IDR 100.000<br>Pelunasan Dapat Dilakukan Pada Saat Pengambilan Baju<br>Stock Terbatas!!!<br><strong>PEMESANAN DAPAT DILAKUKAN MELALUI WEB INI DENGAN MENGISI FORM DI BAWAH</strong><br>Bukti Transfer dikirim ke CP via WhatsApp Yogi (082236302253), atau melalui korti jurusan masing-masing.<br>Batas Pemesanan: <br> <strong>PO 1 24 Agustus – 3 September 2020<br>PO 2 Dimulai Tanggal 4 September 2020</strong> DENGAN HARGA NORMAL.<br>HIDUP TEKNIK !!!<br><strong>#GrAnaT2020</strong><br><strong>#GandaraGardapati</strong>');

                          $('#modalIklan #modalIklanimage').attr('src', '{{ asset('/img/postergranat.jpg') }}');

                          $('#modalIklan').modal('show');

                        }else{

                          $('#modalIklan #modalIklantitle').html('Bursa SMFT 2020');

                          $('#modalIklan #iklanpict').attr('src', '{{ asset('/img/null.png') }} ');

                          $('#modalIklan #modalIklantext').html(' ');

                          $('#modalIklan #modalIklanimage').attr('src', '{{ asset('/img/bursa.jpg') }}');

                          $('#modalIklan').modal('show');

                        }

                      }else{

                        $('#modalIklan').modal('hide');

                      }

                        $('#modalIklan #btn-close-iklan').hide().delay(3000).show(0);

                    });

                }

            }



            window.setTimeout(function() {

              // console.log('first 10 secs');

                getPembelianBaju();

            }, 30000);

        });

    </script>

    @yield('custom_javascript')

</body>

</html>

