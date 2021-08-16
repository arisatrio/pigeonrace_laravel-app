<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Racing Pigeon</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/css/landing.css') }}" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold text-uppercase" href="#page-top">Merpati Pos Race</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-outline-primary px-3 mb-2 mb-lg-0 nav-link text-primary me-lg-3"
                            href="{{ route('login') }}">LOGIN</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-outline-primary px-3 mb-2 mb-lg-0 nav-link text-primary me-lg-3" href="{{ route('register') }}">REGISTER</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Call to action section-->
    <section class="cta">
        <div class="cta-content">
            <div class="container px-5">
                <h2 class="text-white display-1 lh-1 mb-4">
                    Join,<br />
                    Race, <br>
                    Track, <br>
                    and Upload.
                </h2>
                <a class="btn btn-outline-light py-3 px-4 rounded-pill" href="{{ route('register') }}">REGISTER</a>
            </div>
        </div>
    </section>

    <!-- App features section-->
    <section id="features">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-12 order-lg-1 mb-5 mb-lg-0">
                    <div class="container-fluid px-5">
                        <div class="row gx-5">
                            <div class="col-md-3 mb-5">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="fas fa-calendar-alt icon-feature text-primary mb-3 fa-5x"></i>
                                    <h3 class="font-alt">Join Events</h3>
                                    <p class="text-muted mb-0">Ready to use HTML/CSS device mockups, no Photoshop
                                        required!</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-5">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="fas fa-flag-checkered icon-feature text-primary mb-3 fa-5x"></i>
                                    <h3 class="font-alt">Race</h3>
                                    <p class="text-muted mb-0">Put an image, video, animation, or anything else in the
                                        screen!</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-5">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="fas fa-map-marked-alt icon-feature text-primary mb-3 fa-5x"></i>
                                    <h3 class="font-alt">Track</h3>
                                    <p class="text-muted mb-0">Put an image, video, animation, or anything else in the
                                        screen!</p>
                                </div>
                            </div>
                            <div class="col-md-3 mb-5">
                                <!-- Feature item-->
                                <div class="text-center">
                                    <i class="fas fa-camera icon-feature text-primary mb-3 fa-5x"></i>
                                    <h3 class="font-alt">Upload</h3>
                                    <p class="text-muted mb-0">Put an image, video, animation, or anything else in the
                                        screen!</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer-->
    <footer class="bg-black text-center py-5">
        <div class="container px-5">
            <div class="text-white-50 small">
                <div class="mb-2">&copy; AFEDIGI 2021</div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../assets/js/landing.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
</body>

</html>