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
    <!-- Responsive datatable examples -->
    <link href="{{asset('assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold text-uppercase" href="{{ route('welcome') }}">Merpatipos.com</a>
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
                                            <a onclick="goBack()" class="btn btn-grey">
                                                <i class="fas fa-arrow-left"></i>
                                            </a>
                                            <button type="button" class="btn btn-primary">
                                                <i class="fas fa-users"></i>
                                                TOTAL POS
                                            </button>
                                            <button type="button" class="btn btn-info text-white">
                                                {{ $kelas->nama_kelas }}
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col">
                                            @foreach ($race->kelas as $item)
                                            <a class="btn btn-info btn-sm text-white" href="{{ route('total-pos-kelas', ['race_id' => $race->id, 'kelas_id' => $item->id]) }}">
                                                {{ $item->nama_kelas }}
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-bordered" id="table-1">
                                                <thead>
                                                    <tr class="text-center bg-dark">
                                                        <th colspan="4" class="text-white">Data Peserta</th>
                                                        @foreach ($race->pos as $item)
                                                        <th colspan="2" class="text-white">POS-{{ $item->no_pos }}</th>
                                                        @endforeach
                                                        <th colspan="2" class="text-white">TOTAL POS</th>
                                                    </tr>
                                                    <tr class="text-center">
                                                      <th rowspan="2" style="width: 5%;" class="bg-danger text-white">ACE RANK</th>
                                                      <th rowspan="2" class="bg-info text-white">Nama Peserta</th>
                                                      <th rowspan="2" class="bg-info text-white">Kota</th>
                                                      <th rowspan="2" class="bg-info text-white">No. Ring</th>
                                                      @foreach ($race->pos as $item)
                                                      <th rowspan="1" colspan="@if($totalPos === 1) 2 @else {{$totalPos}} @endif" class="bg-success text-center text-white">{{ $item->city }}</th>
                                                      @endforeach
                                                      <th rowspan="2" class="bg-warning text-white">Clock</th>
                                                      <th rowspan="2" class="bg-warning text-white" style="width: 5%;">Kecepatan Rata-rata</th>
                                                    </tr>
                                                    <tr class="text-center">
                                                        @for ($i = 0; $i < $totalPos; $i++)
                                                        <th class="bg-info text-white" style="width: 10%;">Velocity</th>
                                                        <th class="bg-info text-white" style="width: 5%;">Rank</th>
                                                        @endfor                            
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @foreach ($basketing as $item)
                                                        <tr>
                                                            <td class="text-center"></td> 
                                                            <td>{{ $item->user->name }}</td>
                                                            <td>{{ $item->user->city }}</td>
                                                            <td>{{ Helper::noRing($item->club->nama_club, $item->tahun, $item->no_ring) }}</td>
                                                            @foreach($race->pos as $pos)
                                                            
                                                                @foreach ($item->clockModel as $burungClock)
                                                                    @if ($pos->id === $burungClock->race_pos_id)
                                                                        <td class="text-center"><b>{{ $burungClock->velocity }} M/Menit</b></td>
                                                                        <td class="text-center">{{ $burungClock->rank }}</td>
                                                                    @else
                                                                        <td class="bg-danger"></td>
                                                                        <td class="bg-danger"></td>
                                                                    @endif
                                                                @endforeach
                                                            
                                                            
                                                            @endforeach
                                                            <td class="text-center">{{ $item->clockModel->count() }}</td>
                                                            <td class="text-center"><b>{{ Helper::getAvgSpeed($item->clockModel) }} M/Menit</b></td>
                                                        </tr>
                                                    @endforeach

                                                    
                                                    {{-- @foreach ($clock as $key => $item)
                                                        <tr>
                                                            <td class="text-center"></td> 
                                                            <td>{{ $item->burung->user->name }}</td>
                                                            <td>{{ $item->burung->user->city }}</td>
                                                            <td>{{ Helper::noRing($item->burung->club->nama_club, $item->burung->tahun, $item->burung->no_ring) }}</td>
                                                            @foreach($race->pos as $pos)
                                                            
                                                                @if ($pos->id === $item->race_pos_id)
                                                                    <td class="text-center"><b>{{ $item->velocity }} M/Menit</b></td>
                                                                    <td class="text-center">{{ $item->rank($key) }}</td>
                                                                @else
                                                                    <td class="bg-danger"></td>
                                                                    <td class="bg-danger"></td>
                                                                @endif
                                                            
                                                            @endforeach
                                                            <td class="text-center">{{ $item->clock->count() }}</td>
                                                            <td class="text-center"><b>{{ Helper::getAvgSpeed($item->clock) }} M/Menit</b></td>
                                                        </tr>
                                                    @endforeach --}}

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
            var t = $('#table-1').DataTable({
                responsive: true,
                order: [[5+(@JSON($totalPos)*2), 'desc'], [4+(@JSON($totalPos)*2), 'desc']]
            });
            t.column(0).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } );
        function goBack() {
          window.history.back();
        }
    </script>
    
    <!-- Core theme JS-->
</body>

</html>