

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            @include('layouts.inc.all-navbar')

            <!-- Sidebar Toggle-->
            <!-- Navbar Search-->
            <!-- Navbar-->
   
            {{-- <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    
                        <li><a class="dropdown-item" href=" {{ url('target_actor/profile/'.Auth::user()->id )}}">My Account</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            
                        </li>
                    </ul>
                </li>
            </ul> --}}
        </nav>