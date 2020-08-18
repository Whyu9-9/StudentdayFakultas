<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SMFT - @if(Auth::user("admin")->name!=null){{Auth::user("admin")->name}}@endif</title>
    <meta name="description:" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('/img/favicon.png') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <!-- Font-Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('/css/fontawesome-all.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/css/bootadmin.min.css') }}">
    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('/css/datatables.min.css') }}">

    <style>
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
    </style>

</head>
<body class="bg-light">

    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <a class="sidebar-toggle mr-3" href="#"><i class="fa fa-bars"></i></a>
        <a class="navbar-brand" href="{{ route('admin.index') }}">Dashboard Admin</a>

        <div class="navbar-collapse collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a href="#" id="dd_user" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user('admin')->name }}</a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd_user">
                        <a href="{{ route('admin.password-reset-form') }}" class="dropdown-item">
                            <i class="fa-key fa"></i> Ganti Password
                        </a>
                        <a class="dropdown-item" href="/admin/logout">
                            <i class="fa fa-power-off"></i>
                            Logout
                        </a>

                        {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> --}}
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        <div class="sidebar sidebar-dark bg-dark">
            <ul class="list-unstyled">
                <li class="@yield('active1')"><a href="{{ route('admin.index') }}"><i class="fa fa-fw fa-home"></i> Beranda</a></li>
                <li class="@yield('active2')"><a href="{{ route('admin.mahasiswa') }}"><i class="fa fa-fw fa-user"></i> Mahasiswa</a></li>
                <li class="@yield('active3')"><a href="{{ route('admin.note-mahasiswa') }}"><i class="fa fa-fw fa fa-sticky-note"></i> List Note</a></li>
                <li class="@yield('active4')"><a href="{{ route('admin.sd-pengumuman') }}"><i class="fa fa-fw fa-bell"></i> Pengumuman</a></li>
                <!--
                <li class="@yield('penugasan')">
                    <a href="{{ route('penugasan.setting') }}">
                        <i class="fas fa-fw fa-file-pdf"></i> Penugasan
                    </a>
                </li>
                <li class="@yield('resume')">
                    <a href="#resume_expand_1" data-toggle="collapse">
                        <i class="fas fa-fw fa-file-pdf"></i> Resume
                    </a>
                    <ul id="resume_expand_1" class="list-unstyled collapse">
                        <li class="@yield('activeR1')"><a href="{{ route('admin.resume-setting') }}">Resume Setting</a></li>
                        <li class="@yield('activeR2')"><a href="{{ route('admin.resume-index') }}">Resume Data</a></li>
                    </ul>
                </li>
                -->
                <li class="@yield('master_data')">
                    <a href="#sm_expand_1" data-toggle="collapse">
                        <i class="fa fa-fw fa-database"></i> Master Data
                    </a>
                    <ul id="sm_expand_1" class="list-unstyled collapse">
                        <li class="@yield('activeM1')"><a href="{{ route('admin.angkatan-index') }}">Angkatan</a></li>
                        <li class="@yield('activeM2')"><a href="{{ route('admin.golongan-darah-index') }}">Golongan darah</a></li>
                        <li class="@yield('activeM3')"><a href="{{ route('admin.jenis-kelamin-index') }}">Jenis kelamin</a></li>
                        <li class="@yield('activeM4')"><a href="{{ route('admin.program-studi-index') }}">Program Studi</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="content" style="background-color:#f5f5f5">
            <div class="p-4">
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
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
    
    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        } );
    </script>
    <!-- Custom Javascript -->
    @yield('custom_javascript')
</body>
</html>