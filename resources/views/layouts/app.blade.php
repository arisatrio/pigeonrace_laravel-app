<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title') &mdash; Merpati Pos</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <!-- CSS Libraries -->
    @stack('css_script')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
</head>
<body class="@if (Auth::user()->isAdmin()) sidebar-mini @endif sidebar-gone ">
    <div id="app">
        <div class="main-wrapper">

            {{-- NAVBAR --}}
            <div class="navbar-bg @if(Auth::user()->isUser()) bg-dark @endif"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                @if (Auth::user()->isAdmin())
                <ul class="navbar-nav navbar-right">
                    <h6 class="text-white text-uppercase">{{ auth()->user()->name }}</h6>
                </ul>
                @endif
            </nav>

            {{-- SIDE BAR --}}
            @if (Auth::user()->isUser())
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('user.home') }}">{{ auth()->user()->name }}</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('user.home') }}">{{ auth()->user()->name }}</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="nav-item @if(Route::currentRouteName()==='user.home') active @endif">
                            <a href="{{ route('user.home') }}" class="nav-link"><i class="fas fa-home"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="menu-header">Race</li>
                        <li class="nav-item @if(Route::currentRouteName()==='user.race.index') active @endif">
                            <a href="{{ route('user.race.index') }}" class="nav-link"><i class="fas fa-calendar-alt"></i>
                                <span>Jadwal Race</span>
                            </a>
                        </li>
                        <li class="nav-item @if(Route::currentRouteName()==='user.riwayat-index') active @endif">
                            <a href="{{ route('user.riwayat-index') }}" class="nav-link"><i class="fas fa-history">
                                </i><span>Riwayat</span>
                            </a>
                        </li>
                        <li class="menu-header">Profile</li>
                        <li class="nav-item @if(Route::currentRouteName()==='user.profile.edit') active @endif">
                            <a href="{{ route('user.profile.edit', auth()->user()->id) }}" class="nav-link"><i class="fas fa-map-marker-alt">
                                </i><span>Koordinat</span>
                            </a>
                        </li>
                        <li class="nav-item @if(Route::currentRouteName()==='user.burung.index') active @endif">
                            <a href="{{ route('user.burung.index') }}" class="nav-link"><i class="fas fa-dove">
                                </i><span>Burung</span>
                            </a>
                        </li>
                        <li class="nav-item @if(Route::currentRouteName()==='user.edit-profile') active @endif">
                            <a href="{{ route('user.edit-profile', auth()->user()->id) }}" class="nav-link"><i class="fas fa-user">
                                </i><span>Akun</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="{{ route('logout') }}" id="logout-form" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i><span>Keluar</span> 
                                </a>
                            </form>
                        </li>
                    </ul>
                </aside>
            </div>
            @elseif (Auth::user()->isAdmin())
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('admin.dashboard') }}">Merpati Pos</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('admin.dashboard') }}">MP</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="nav-item @if(Route::currentRouteName()==='admin.dashboard') active @endif">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="fas fa-home"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-header">Race</li>
                        <li class="nav-item @if(Route::currentRouteName()==='admin.race-results.index') active @endif">
                            <a class="nav-link" href="{{ route('admin.race-results.index') }}">
                                <i class="fas fa-flag-checkered"></i>
                                <span>Hasil Race</span>
                            </a>
                        </li>
                        <li class="menu-header">Master Data</li>
                        <li class="nav-item @if(Route::currentRouteName()==='admin.race.index') active @endif">
                            <a class="nav-link" href="{{ route('admin.race.index') }}">
                                <i class="fas fa-database"></i>
                                <span>Data Race</span>
                            </a>
                        </li>
                        <li class="nav-item @if(Route::currentRouteName()==='admin.club.index') active @endif">
                            <a class="nav-link" href="{{ route('admin.club.index') }}">
                                <i class="fas fa-users"></i>
                                <span>Data Club</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            
                            <a class="nav-link text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Keluar</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </aside>
            </div>
            @else
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('superadmin.dashboard') }}">Logo</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('superadmin.dashboard') }}">LOGO</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="nav-item">
                            <a href="{{ route('superadmin.dashboard') }}" class="nav-link"><i class="fas fa-fire">
                                </i><span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-header">User Management</li>
                        <li>
                            <a class="nav-link" href="{{ route('superadmin.user.index') }}">
                                <i class="fas fa-users"></i>
                                <span>Data User</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="{{ route('logout') }}" id="logout-form" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i><span>Keluar</span> 
                                </a>
                            </form>
                        </li>
                    </ul>
                </aside>
            </div>
            @endif

            <!-- MAIN CONTENT -->
            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2021 <div class="bullet"></div> AFEDIGI</a>
                </div>
                <div class="footer-right">
                    0.1
                </div>
            </footer>

        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.inputmask.js') }}"></script>
    @stack('js_script')
</body>
</html>