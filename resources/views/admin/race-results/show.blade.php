@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>{{ $race->nama_race }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.race-results.index') }}">Hasil Race</a></div>
        <div class="breadcrumb-item">{{ $race->nama_race }}</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="card">
              <div class="card-body">
                
                <ul class="nav nav-pills mb-3">
                  <li class="nav-item">
                    <a class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="{{ route('admin.race-results.index') }}">
                      <i class="fas fa-arrow-left"></i>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm mr-2" href="#">
                      <i class="fas fa-users"></i>
                      Data Peserta
                    </a>
                  </li>
                </ul>

                <ul class="nav nav-pills mb-3">
                  @foreach ($race->pos as $item)
                  <li class="nav-item">
                      <a class="nav-link text-white btn-warning btn-sm mr-2" href="{{ route('admin.basketing.index', ['race_id' => $race->id, 'id' => $item->id]) }}">Basketing {{ $item->no_pos }}</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link text-white btn-success btn-sm mr-2" href="{{ route('admin.pos.index', ['race_id' => $race->id, 'id' => $item->id]) }}">POS {{ $item->no_pos }}</a>
                  </li>
                  @endforeach
                  <li class="nav-item">
                    <a class="nav-link text-white btn-danger btn-sm" href="{{ route('admin.total-pos', $race->id) }}">TOTAL POS</a>
                  </li>
                </ul>
                
                <div class="tab-content">
                  <div class="tab-pane fade active show">

                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                          <thead>
                            <tr class="text-center bg-dark">
                              <th colspan="{{6+$race->pos->count()}}" class="text-white">Data Peserta - {{ $race->nama_race }}</th>
                            </tr>
                              <tr class="bg-primary">
                                  <th rowspan="2" class="text-white">No</th>
                                  <th rowspan="2" class="text-white">Nama</th>
                                  <th rowspan="2" class="text-white">Kota</th>
                                  <th colspan="2" class="text-center text-white">Koordinat</th>  
                                  <th colspan="{{$race->pos->count()}}" class="text-center text-white">Jarak (KM)</th>
                                  <th rowspan="2" class="text-white">MAP</th>
                              </tr>
                              <tr class="bg-primary">
                                <th class="text-white">Latitude</th>
                                <th class="text-white">Longitude</th>
                                @foreach ($race->pos as $item)
                                <th class="text-white">POS {{ $item->no_pos }}</th>
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
                                      {{ Helper::calculateDistance($item->latitude, $item->longitude, $pos->latitude, $pos->longitude) }} KM
                                  </td>                           
                                  @endforeach
                                  <td>
                                    <a href="{{ route('admin.cek-map', $item->id) }}">CEK</a>
                                  </td>
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
@endsection
@push('css_script')
    @include('layouts.datatable-css-assets')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css">
@endpush
@push('js_script')
    @include('layouts.datatable-js-assets')
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
            function goBack() {
              window.history.back();
            }
        } );
    </script>
     <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap4.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
@endpush