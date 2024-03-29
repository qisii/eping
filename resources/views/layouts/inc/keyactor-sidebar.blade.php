<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ url('key_actor/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                
                <a class="nav-link" href=" {{ url('key_actor/feed' )}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-comment"></i></div>
                    Feed
                </a>

                <a class="nav-link" href="{{ url('key_actor/material') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-book"></i></div>
                    Module
                </a>
                <div class="sb-sidenav-menu-heading">Settings</div>
                <a class="nav-link" href=" {{ url('key_actor/profile/'.Auth::user()->id )}}"">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Profile
                </a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: {{ Auth::user()->first_name }}</div>
        </div>
    </nav>
</div>