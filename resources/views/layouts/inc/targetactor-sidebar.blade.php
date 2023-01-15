


<style>
    :root {
        /* preset colors */
        --darkred: #591515;
        --lightred: #F22E2E;
        --medred: #da2626;
        --greyred: #8C6C61;
        --black:#08080D;
        --white:#fff;
        --gray: #D9D9D9;
        --light-color:#666;
        --light-bg:#eee;
        --border:.2rem solid rgba(0,0,0,.1);
        --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
    }
    .sb-sidenav {
        background: var(--white); 
        border-right: 1px solid #343a40;
    }
    .nav-link span {
        color: var(--light-color);
        transition: .5s ease-in-out;
        
    }

    .nav-link span:hover {
        
        color: var(--lightred);
        /* font-weight: 600; */
    }
    .sb-sidenav-menu-heading span{
        color: #343a40;
    }
    a > div > i {
        color: red;
    }
</style>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading"><span>Core</span></div>
                <a class="nav-link fw-semibold" href="{{ url('target_actor/dashboard') }}">
                    <div class="sb-nav-link-icon text-danger"><i class="fas fa-tachometer-alt"></i></div>
                   <span>Dashboard</span>
                </a>
                <a class="nav-link" href="{{ url('target_actor/viewlegit') }}">
                    <div class="sb-nav-link-icon text-danger"><i class="fa-solid fa-map"></i></div>
                   <span>View Awareness Map</span>
                </a>
                <a class="nav-link" href="{{ url('target_actor/viewreport') }}">
                    <div class="sb-nav-link-icon text-danger"><i class="fa-sharp fa-solid fa-ticket"></i></div>
                    <span>My Reports</span>
                </a>
                <div class="sb-sidenav-menu-heading"><span>Media</span></div>
                <a class="nav-link" href=" {{ url('target_actor/feed-view' )}}">
                    <div class="sb-nav-link-icon text-danger"><i class="fa-solid fa-comment"></i></div>
                    <span>Feeds</span>
                </a>
                <a class="nav-link" href=" {{ url('target_actor/module-view' )}}">
                    <div class="sb-nav-link-icon text-danger"><i class="fa-solid fa-book"></i></div>
                    <span>Modules</span>
                </a>
                <div class="sb-sidenav-menu-heading"><span>Settings</span></div>
                <a class="nav-link" href=" {{ url('target_actor/profile/'.Auth::user()->id )}}">
                    <div class="sb-nav-link-icon text-danger"><i class="fa-solid fa-user"></i></div>
                    <span>Profile</span>
                </a>
                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="sb-nav-link-icon text-danger"><i class="fa-solid fa-right-from-bracket"></i></div>
                    <span>Logout</span>
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