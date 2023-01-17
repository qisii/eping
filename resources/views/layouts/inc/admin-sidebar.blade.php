<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ url('admin/dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ url('admin/ticketreports') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-ticket"></i></div>
                    Report Ticket List
                </a>
                <a class="nav-link" href="{{ url('admin/users') }}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Manage Users
                </a>
                <div class="sb-sidenav-menu-heading">Settings</div>
                <a class="nav-link" href=" {{ url('admin/profile/'.Auth::user()->id )}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                    Profile
                </a>
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-right-from-bracket"></i></div>
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: Admin {{ Auth::user()->first_name }}</div>
            
        </div>
    </nav>
</div>