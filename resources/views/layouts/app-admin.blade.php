<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Dashboard &mdash; Merpati Pos</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="../node_modules/weathericons/css/weather-icons.min.css">
    <link rel="stylesheet" href="../node_modules/weathericons/css/weather-icons-wind.min.css">
    <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg bg-dark"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Template update is available now!
                                        <div class="time text-primary">2 Min Ago</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <!-- <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1"> -->
                            <div class="d-sm-none d-lg-inline-block">Hi, Ujang</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="features-settings.html" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="{{ route('logout') }}" id="logout-form" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="dashboard.html">Merpati Pos</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="dashboard.html">MP</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="nav-item active">
                            <a href="dashboard.html" class="nav-link"><i class="fas fa-fire">
                                </i><span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-header">Events</li>
                        
                        <li>
                            <a class="nav-link" href="events.html">
                                <i class="far fa-calendar-alt"></i>
                                <span>Events</span>
                            </a>
                        </li>
                        <li class="menu-header">Data</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-database"></i><span>Master Data</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="pomp.html">Data POMP</a></li>
                                <li><a class="nav-link" href="kandang.html">Data Kandang</a></li>
                                <li><a class="nav-link" href="burung.html">Data Burung</a></li>
                                <li><a class="nav-link" href="lepasan.html">Data Lokasi Lepasan</a></li>
                            </ul>
                        </li>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Total POPM</h4>
                                    </div>
                                    <div class="card-body">
                                        10
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-danger">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>TOTAL KANDANG</h4>
                                    </div>
                                    <div class="card-body">
                                        42
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-dove"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>TOTAL BURUNG</h4>
                                    </div>
                                    <div class="card-body">
                                        1,201
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>TOTAL LOKASI LEPASAN</h4>
                                    </div>
                                    <div class="card-body">
                                        47
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-4">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Recent Event
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Event 1</a>
                                <a class="dropdown-item" href="#">Event 2</a>
                                <a class="dropdown-item" href="#">Event 2</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Rank</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled list-unstyled-border">
                                        <li class="media">
                                            <div class="badge badge-secondary rounded-circle">1</div>
                                            <div class="media-body">
                                                <div class="float-right">1000mpm</div>
                                                <div class="badge badge-danger">4121-2122-2019-BR-Red-J</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="badge badge-secondary rounded-circle">2</div>
                                            <div class="media-body">
                                                <div class="float-right">900mpm</div>
                                                <div class="badge badge-primary">555-1212-2016-BR-Red-J</div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <div class="badge badge-secondary rounded-circle">3</div>
                                            <div class="media-body">
                                                <div class="float-right">890mpm</div>
                                                <div class="badge badge-success">2322-7676-2018-BR-Red-J</div>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="text-center pt-1 pb-1">
                                        <a href="race-result.html" class="text-primary">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Top Kandang</h4>
                                </div>
                                <div class="card-body">
                                    <div class="summary">
                                        <div class="summary-item">
                                            <ul class="list-unstyled list-unstyled-border">
                                                <li class="media">
                                                    <a href="#">
                                                        <img class="mr-3 rounded" width="50"
                                                            src="../assets/img/avatar-1.png" alt="product">
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="media-right">5</div>
                                                        <div class="media-title"><a href="#">Kandang Satu</a></div>
                                                        <div class="text-muted text-small">PPOM <a href="#">Mataram</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <a href="#">
                                                        <img class="mr-3 rounded" width="50"
                                                            src="../assets/img/avatar-1.png" alt="product">
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="media-right">3</div>
                                                        <div class="media-title"><a href="#">Kandang Dua</a></div>
                                                        <div class="text-muted text-small">PPOM <a href="#">Elang</a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <a href="#">
                                                        <img class="mr-3 rounded" width="50"
                                                            src="../assets/img/avatar-1.png" alt="product">
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="media-right">5</div>
                                                        <div class="media-title"><a href="#">Kandang Tiga</a></div>
                                                        <div class="text-muted text-small">PPOM <a href="#">Ababil</a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Top POPM</h4>
                                </div>
                                <div class="card-body">
                                    <div class="summary">
                                        <div class="summary-item">
                                            <ul class="list-unstyled list-unstyled-border">
                                                <li class="media">
                                                    <a href="#">
                                                        <img class="mr-3 rounded" width="50"
                                                            src="../assets/img/avatar-1.png" alt="product">
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="media-right">55</div>
                                                        <div class="media-title"><a href="#">Mataram</a></div>
                                                    </div>
                                                </li>
                                                <li class="media">
                                                    <a href="#">
                                                        <img class="mr-3 rounded" width="50"
                                                            src="../assets/img/avatar-1.png" alt="product">
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="media-right">35</div>
                                                        <div class="media-title"><a href="#">Elang</a></div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Race Statistics</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <iframe
                                            src="https://www.google.com/maps/d/embed?mid=1Z5PHn-XMkUhC7cDcplybD82LX3A&hl=en"
                                            width="100%" height="480">
                                        </iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="../assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="../node_modules/simpleweather/jquery.simpleWeather.min.js"></script>
    <script src="../node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="../node_modules/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="../node_modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
    <script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <!-- Template JS File -->
    <script src="../assets/js/scripts.js"></script>
    <script src="../assets/js/custom.js"></script>

    <!-- Page Specific JS File -->
    <script src="../assets/js/page/index-0.js"></script>
</body>

</html>