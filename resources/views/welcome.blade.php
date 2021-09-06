<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Merpati Pos</title>
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
            <a class="navbar-brand fw-bold text-uppercase" href="#page-top">Merpati Pos</a>
        </div>
    </nav>


    <!-- Call to action section-->
    <section class="cta">
        <div class="cta-content">
            <div class="container px-5">
                <h2 class="text-white display-1 lh-1 mb-4">
                    Aplikasi <br> Lomba <br> Merpati <br> Pos<br />
                </h2>
                <a class="btn btn-outline-light py-3 px-4 rounded" href="{{ route('login') }}">LOGIN</a> <div class="m-2"></div>
                <a class="btn btn-outline-light py-3 px-4 rounded" href="{{ route('register') }}">REGISTER</a>
            </div>
        </div>
    </section>

    <!-- App features section-->
    <section id="features">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-12 order-lg-1 mb-5 mb-lg-0">
                    <div class="container-fluid px-5">

                        <div class="row mb-4">
                            <div class="col">
                                <h1 class="lh-1 mb-4">HASIL RACE</h1>
                                <hr>
                            </div>
                        </div>

                        <div class="row gx-5">
                            @foreach ($race as $item)
                            <div class="col-md-4 mb-5">
                                <!-- Feature item-->
                                <div class="card">
                                    <div class="card-header">
                                        <img src="{{ asset('assets/img/poster/'.$item->poster) }}" class="img-fluid" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h3 class="font-alt">{{ $item->nama_race }}</h3>
                                        <p>{{ $item->deskripsi }}</p>
                                        <a href="{{ route('race', $item->id) }}" class="btn btn-primary">BUKA</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
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
</body>

</html>