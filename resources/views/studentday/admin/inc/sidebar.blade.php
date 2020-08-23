<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="#">
            <img src="{{ asset('dashboard/images/icon/logo-white.png') }}" alt="Cool Admin" />
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li class="{{ Request::path() == 'admin/beranda' ? 'active' : '' }}">
                    <a class="js-arrow" href="/admin/beranda">
                        <i class="fa fa-home"></i>Beranda</a>
                </li>
                <li class="{{ Request::path() == 'admin/mahasiswa' ? 'active' : '' }}">
                    <a href="/admin/mahasiswa">
                        <i class="fa fa-user"></i>Mahasiswa
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->