<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    @include('layouts.external-stylesheets')
    <link rel="stylesheet" href="/css/admin/admin.css" />
    @yield('css')
  </head>
  <body>
    <!-- main container starts -->

    <div class="main-container d-flex">
      <!-- sidebar div starts -->

      <div class="sidebar shadow" id="side_nav">
        <!-- sidebar top starts -->

        <div class="header-box px-2 pt-3 pb-4">
          <h1 class="fs-4">
            <span class="bg-white text-dark shadow rounded px-2 mx-2">LOGO</span
            ><span class="text-black">ePing!</span>
          </h1>
          <button class="btn d-md-none d-block close-btn px-1 py-0 text-white">
            <i class="fas fa-stream"></i>
          </button>
        </div>

        <!-- sidebar top ends -->

        <!-- top navigation side panel starts-->
        <ul class="list-unstyled">
          <li class="nav-dashboard">
            <a class="px-3 py-2 d-block" href="{{ url('key_actor/dashboard' )}}"
              ><i class="fa-solid fa-chart-line"></i> Dashboard</a
            >
          </li>
          <li class="nav-manage">
            <a class="px-3 py-2 d-block" href="{{ url('key_actor/feed' )}}"
              ><i class="fa-solid fa-bars-progress"></i>Management</a
            >
          </li>
        </ul>

        <!-- top navigation side panel ends-->
        <hr class="h-color mx-3" />

        <!-- bottom navigation side panel starts-->
        <ul class="list-unstyled">
          <li>
            <a class="px-3 py-2 d-block" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
          </li>
        </ul>
      </div>
      <div class="content">
        <section class="hero">
            @yield('content')
        </section>
          @yield('popup')
      </div>
    </div>
  </body>
</html>
