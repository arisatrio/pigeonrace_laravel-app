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
                              <tr>
                                  <th rowspan="2">No</th>
                                  <th rowspan="2">Nama Peserta / Loft</th>
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
@endsection
@push('css_script')
    @include('layouts.datatable-css-assets')
@endpush
@push('js_script')
    @include('layouts.datatable-js-assets')
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable();
        } );
    </script>
@endpush