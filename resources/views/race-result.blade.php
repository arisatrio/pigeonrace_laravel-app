<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Merpatipos.com</title>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css">
    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold text-uppercase" href="#page-top">Merpatipos.com</a>
        </div>
    </nav>


    <!-- App features section-->
    <section id="features">
        <div class="px-5">
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
                                            <a class="btn btn-warning btn-sm text-white" href="{{ route('basketing', ['race_id' => $race->id, 'id' => $item->id]) }}">
                                                Basketing {{ $item->no_pos }}
                                            </a>
                                            <a class="btn btn-success btn-sm text-white" href="{{ route('pos', ['race_id' => $race->id, 'id' => $item->id]) }}">
                                                POS {{ $item->no_pos }}
                                            </a>
                                            @endforeach
                                            <a class="btn btn-danger btn-sm text-white" href="{{ route('total-pos', $race->id) }}">
                                                TOTAL POS
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-bordered" id="table-1">
                                                <thead>
                                                    <tr class="text-center bg-dark">
                                                        <th colspan="{{$race->pos->count()+5}}" class="text-white">Data Peserta</th>
                                                    </tr>
                                                    <tr class="bg-primary text-center">
                                                        <th rowspan="2" class="text-white">No</th>
                                                        <th rowspan="2" class="text-white">Nama Peserta</th>
                                                        <th rowspan="2" class="text-white">Kota</th>
                                                        <th colspan="2" class="text-center text-white">Koordinat</th>  
                                                        <th colspan="{{$race->pos->count()}}" class="text-white text-center">Jarak (KM)</th>
                                                    </tr>
                                                    <tr class="bg-primary text-center">
                                                      <th class="text-white">Latitude</th>
                                                      <th class="text-white">Longitude</th>
                                                      @foreach ($race->pos as $item)
                                                      <th class="text-white">POS {{ $item->no_pos }}</th>
                                                      @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($race->join as $item)
                                                    <tr>
                                                        <td style="width: 5%;">{{ $loop->iteration }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->city }}</td>
                                                        <td class="text-center">{{ $item->latitude }}</td>
                                                        <td class="text-center">{{ $item->longitude }}</td>
                                                        @foreach ($race->pos as $pos)
                                                        <td class="text-center">
                                                            {{ Helper::calculateDistance($item->latitude, $item->longitude, $pos->latitude, $pos->longitude) }} KM
                                                        </td>                           
                                                        @endforeach
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

    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
        
    <script>
        $(document).ready(function() {
            var race = @JSON($race->nama_race);
            $('#table-1').DataTable({
                dom: 'lBfrtip',
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [
                    { 
                        extend: 'pdf', 
                        className: 'btn btn-secondary', 
                        text: 'PDF',
                        messageTop: 'Data Peserta '+race,
                    },
                    { 
                        extend: 'excel', 
                        className: 'btn btn-secondary', 
                        text: 'Excel',
                        messageTop: 'Data Peserta '+race,
                    },
                ],
            });
        } );
        function goBack() {
          window.history.back();
        }
    </script>
    
    <!-- Core theme JS-->
</body>

</html>