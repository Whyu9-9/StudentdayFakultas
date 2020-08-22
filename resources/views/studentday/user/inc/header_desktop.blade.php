<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="header-button">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                <img src="{{ asset('dashboard/images/icon/avatar-01.jpg') }}" alt="John Doe" />
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">
                                    @if(Auth::user()->nama_panggilan)
                                        {{ Auth::user()->nama_panggilan }}
                                    @else
                                        {{ Auth::user()->nim }}
                                    @endif
                                </a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        <a href="#">
                                            <img src="{{ asset('dashboard/images/icon/avatar-01.jpg') }}" alt="John Doe" />
                                        </a>
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="#">{{ Auth::user()->nama }}</a>
                                        </h5>
                                        <span class="email">{{ Auth::user()->nim }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <a href="/ganti_password"><i class="zmdi zmdi-key"></i> Ganti Password</a>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="zmdi zmdi-power"></i> Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->