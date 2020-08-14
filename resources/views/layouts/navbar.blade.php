<header id="header">
    <div class="container">

        <div id="logo" class="pull-left">
        <!-- <a href="#hero"><img src="img/logo.png" alt="" title="" /></img></a> -->
        <!-- Uncomment below if you prefer to use a text logo -->
        <h1><a href="/">SMFT</a></h1>
        </div>

        <nav id="nav-menu-container">
        <ul class="nav-menu">
            <li class="@yield('active_home')"><a href="/#hero">Home</a></li>
            <li><a href="/#about">Tentang</a></li>
            {{-- <li><a href="#services">Organisasi</a></li> --}}
            <li><a href="/gallery">Galeri</a></li>
            <li class="menu-has-children"><a href="#">Event</a>
            <ul>
                <li><a href="{{ route('sd.index') }}">Student Day</a></li>
                <li><a href="/bkm">BKM</a></li>
                <li><a href="/granat">GrAnaT</a></li>
                <li><a href="#">Bazzar Teknik</a></li>
                <li><a href="#">TBTN</a></li>
                <li><a href="#">TFT</a></li>
                <li><a href="#">Portek</a></li>
                <li><a href="#">GMT</a></li>
                <li><a href="{{ route('dies.index')}}">Dies Natalis</a></li>
                <li><a href="#">BKFT</a></li>
                <li><a href="#">MUSMA</a></li>
                <li><a href="#">Pemira</a></li>
            </ul>
            </li>
            <li class="menu-has-children @yield('active_penerimaan_mahasiswa')"><a href="#">Penerimaan Mahasiswa</a>
            <ul>
                <li><a href="{{ route('sd.index') }}">Student Day</a></li>
                <li><a href="/bkm">BKM</a></li>
            </ul>
            </li>
            <li><a href="#contact">Kontak</a></li>
        </ul>
        </nav><!-- #nav-menu-container -->
    </div>
</header><!-- #header -->