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
                <li class="{{ Request::path() == 'beranda' ? 'active' : '' }}">
                    <a class="js-arrow" href="/beranda">
                        <i class="fa fa-home"></i>Beranda</a>
                </li>
                <li class="{{ Request::path() == 'biodata' ? 'active' : '' }}">
                    <a href="/biodata">
                        <i class="fa fa-address-card"></i>Biodata
                    </a>
                </li>
                <li class="{{ Request::path() == 'prestasi' ? 'active' : '' }}">
                    <a href="/prestasi">
                        <i class="fa fa-trophy"></i>Prestasi
                    </a>
                </li>
                <li class="{{ Request::path() == 'organisasi' ? 'active' : '' }}">
                    <a href="/organisasi">
                        <i class="fa fa-building"></i>Organisasi
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->