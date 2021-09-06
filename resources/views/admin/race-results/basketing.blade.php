@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>{{ $pos->race->nama_race }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.race-results.index') }}">Hasil Race</a></div>
        <div class="breadcrumb-item">{{ $pos->race->nama_race }}</div>
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
                      <a class="nav-link text-white btn-primary btn-sm mr-2" href="#">
                        <i class="fas fa-dove"></i>
                        Basketing Pos {{ $pos->no_pos }} - {{ $pos->city }}
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
                    <a class="nav-link text-white btn-danger btn-sm" href="#home3">TOTAL POS</a>
                  </li>
                </ul>
                
                <div class="tab-content">
                  <div class="tab-pane fade active show">

                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
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