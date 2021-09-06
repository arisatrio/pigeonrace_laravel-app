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
    
    
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/css/landing.css') }}" rel="stylesheet" />
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold text-uppercase" href="#page-top">Merpati Pos</a>
        </div>
    </nav>


    <!-- App features section-->
    <section id="features">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-12 order-lg-1 mb-5 mb-lg-0">
                    
                    <div class="row mb-4 mt-4">
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <h1>{{ $race->nama_race }}</h1>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <a href="{{ route('welcome') }}" class="btn btn-grey">
                                                <i class="fas fa-arrow-left"></i>
                                            </a>
                                            <a class="btn btn-primary" href="#">
                                                <i class="fas fa-users"></i>
                                                Data Peserta
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            @foreach ($race->pos as $item)
                                            <a class="btn btn-warning btn-sm text-white" href="{{ route('admin.basketing.index', ['race_id' => $race->id, 'id' => $item->id]) }}">
                                                Basketing {{ $item->no_pos }}
                                            </a>
                                            <a class="btn btn-success btn-sm text-white" href="{{ route('admin.basketing.index', ['race_id' => $race->id, 'id' => $item->id]) }}">
                                                POS {{ $item->no_pos }}
                                            </a>
                                            @endforeach
                                            <a class="btn btn-danger btn-sm text-white" href="#">
                                                TOTAL POS
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <table class="table table-bordered table-responsive" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">No</th>
                                                        <th rowspan="2">Nama Peserta</th>
                                                        <th rowspan="2">Kota</th>
                                                        <th colspan="2" class="text-center">Koordinat</th>  
                                                        <th colspan="{{$race->pos->count()}}" class="text-center">Jarak (KM)</th>
                                                        <th rowspan="2">MAP</th>
                                                    </tr>
                                                    <tr>
                                                      <th>Latitude</th>
                                                      <th>Longitude</th>
                                                      @foreach ($race->pos as $item)
                                                      <th>POS {{ $item->no_pos }}</th>
                                                      @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $no = 1 @endphp
                                                    @foreach($race->join as $item)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->city }}</td>
                                                        <td>{{ $item->latitude }}</td>
                                                        <td>{{ $item->longitude }}</td>
                                                        @foreach ($race->pos as $pos)
                                                        <td>
                                                            {{ Helper::calculateDistance($item->latitude, $item->longitude, $pos->latitude, $pos->longitude) }}
                                                        </td>                           
                                                        @endforeach
                                                        <td>CEK</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Required datatable js -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
        
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable();
        } );
    </script>
    
    <!-- Core theme JS-->
</body>

</html><!DOCTYPE html>
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
    
    
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('assets/css/landing.css') }}" rel="stylesheet" />
    <!-- DataTables -->
    <link href="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold text-uppercase" href="#page-top">Merpati Pos</a>
        </div>
    </nav>


    <!-- App features section-->
    <section id="features">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-12 order-lg-1 mb-5 mb-lg-0">
                    
                    <div class="row mb-4 mt-4">
                        <div class="col">
                            <div class="card shadow">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <h1>{{ $race->nama_race }}</h1>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col">
                                            <a onclick="goBack()" class="btn btn-grey">
                                                <i class="fas fa-arrow-left"></i>
                                            </a>
                                            <a class="btn btn-primary" href="#">
                                                <i class="fas fa-users"></i>
                                                Basketing Pos {{ $pos->no_pos }} - {{ $pos->city }}
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            @foreach ($race->pos as $item)
                                            <a class="btn btn-warning btn-sm text-white" href="{{ route('basketing', ['race_id' => $race->id, 'id' => $item->id]) }}">
                                                Basketing {{ $item->no_pos }}
                                            </a>
                                            <a class="btn btn-success btn-sm text-white" href="{{ route('pos', ['race_id' => $race->id, 'id' => $item->id]) }}">
                                                POS {{ $item->no_pos }}
                                            </a>
                                            @endforeach
                                            <a class="btn btn-danger btn-sm text-white" href="#">
                                                TOTAL POS
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <table class="table table-bordered" id="table-1">
                                                <thead>
                                                  <tr class="text-center bg-dark">
                                                    <th class="text-white" colspan="5">Basketing Pos {{ $pos->no_pos }} - {{ $pos->city }}</th>
                                                  </tr>
                                                  <tr class="bg-warning">
                                                      <th style="width: 5%;" class="text-white">No</th>
                                                      <th class="text-white">Ring</th>
                                                      <th class="text-white">Warna</th>
                                                      <th class="text-white">Jenis Kelamin</th>
                                                      <th class="text-white">Nama Peserta / Loft</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                    @php $no = 1 @endphp
                                                    @foreach($pos->basketing as $item)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ Helper::noRing($item->club->nama_club, $item->tahun, $item->no_ring) }}</td>
                                                        <td>{{ $item->warna }}</td>
                                                        <td>{{ $item->jenkel }}</td>
                                                        <td>{{ $item->user->name }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Required datatable js -->
    <script src="{{asset('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <script src="{{asset('assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
        
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable();
        } );
        function goBack() {
          window.history.back();
        }
    </script>
    
    <!-- Core theme JS-->
</body>

</html>