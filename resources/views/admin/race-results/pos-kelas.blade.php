@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>{{ $pos->race->nama_race }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.race-results.index') }}">Hasil Race</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.race-results.show', $pos->race->id) }}">{{ $pos->race->nama_race }}</a></div>
        <div class="breadcrumb-item">POS {{ $pos->no_pos }} - {{ $pos->city }}</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">

          @if (session('messages'))
            <div class="alert alert-success alert-dismissible">
                {{ session('messages') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

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
                            <i class="fas fa-map-marker-alt"></i>
                            Pos {{ $pos->no_pos }} - {{ $pos->city }}
                          </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white btn-info btn-sm mr-2" href="#">
                              {{ $kelas->nama_kelas }}
                            </a>
                        </li>
                    </ul>

                    <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                              <th rowspan="2" style="width: 5%;">No</th>
                              <th rowspan="2">Nama Peserta</th>
                              <th rowspan="2">Kota</th>
                              <th rowspan="1" colspan="3" class="text-center">Data Burung</th>
                              <th rowspan="2">Jarak (KM)</th>
                              <th rowspan="1" colspan="3" class="text-center">Kedatangan</th>
                              <th rowspan="2">Waktu Terbang</th>
                              <th rowspan="2">Kecepatan</th>
                            </tr>
                            <tr>
                                <th>No. Ring</th>
                                <th>Warna</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal</th>
                                <th>H</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1 @endphp
                            @foreach ($rank as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->user->city }}</td>
                                <td>{{ Helper::noRing($item->club->nama_club, $item->tahun, $item->no_ring) }}</td>
                                <td>{{ $item->warna }}</td>
                                <td>{{ $item->jenkel }}</td>
                                <td>{{ $item->clock->distance }}</td>
                                <td>{{ $item->clock->arrival_date->format('d/m/Y') }}</td>
                                <td>{{ $item->clock->arrival_day }}</td>
                                <td>{{ $item->clock->arrival_clock->format('H:i:s') }}</td>
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