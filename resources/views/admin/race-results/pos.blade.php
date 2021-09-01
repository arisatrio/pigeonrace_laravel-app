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
                      <a onclick="goBack()" class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="#home3">
                        <i class="fas fa-arrow-left"></i>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white btn-primary btn-sm mr-2" href="#home3">
                        <i class="fas fa-dove"></i>
                        Pos {{ $pos->no_pos }} - {{ $pos->city }}
                      </a>
                    </li>
                </ul>

                <ul class="nav nav-pills mb-3">
                  <li class="nav-item">
                    <a class="nav-link text-white btn-info btn-sm mr-2" href="#home3">
                      <i class="fas fa-users"></i>
                      Data Peserta
                    </a>
                  </li>
                  @foreach ($race->pos as $item)
                  <li class="nav-item">
                      <a class="nav-link text-white btn-warning btn-sm mr-2" href="{{ route('admin.basketing.index', ['race_id' => $race->id, 'id' => $item->id]) }}">Basketing {{ $item->no_pos }}</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link text-white btn-success btn-sm mr-2" href="{{ route('admin.pos.index', ['race_id' => $race->id, 'id' => $item->id]) }}">POS {{ $item->no_pos }}</a>
                  </li>
                  @endforeach
                  <li class="nav-item">
                    <a class="nav-link text-white btn-danger btn-sm" href="#home3">TOTAL POS</a>
                  </li>
                </ul>
                
                <div class="tab-content">
                  <div class="tab-pane fade active show">

                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Nama Pemilik / Loft</th>
                                  <th>Kota</th>
                                  <th>Jarak (KM)</th>
                                  <th>Burung</th>
                                  <th>Jam dan Tanggal Kedatangan</th>
                                  <th>Waktu Terbang</th>
                                  <th>Kecepatan</th>
                              </tr>
                          </thead>
                          <tbody>
                              @php $no = 1 @endphp
                              @foreach($pos->clock as $item)
                              <tr>
                                  <td>{{ $no++ }}</td>
                                  <td>{{ $item->user->name }}</td>
                                  <td>{{ $item->user->city }}</td>
                                  <td>{{ $item->clock->distance }}</td>
                                  <td>{{ Helper::birdName($item, $item->user->name) }}</td>
                                  <td>{{ $item->clock->arrival_clock->locale('id')->isoFormat('LLLL') }}</td>
                                  <td>{{ $item->clock->flying_time }}</td>
                                  <td>{{ $item->clock->velocity }}</td>
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
        });

        function goBack() {
          window.history.back();
        }
    </script>
@endpush