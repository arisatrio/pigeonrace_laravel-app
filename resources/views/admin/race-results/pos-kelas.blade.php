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
                          <a class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="{{ route('admin.pos.index', ['race_id' => $pos->race->id, 'id' => $pos->id]) }}">
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
                            <tr class="text-center bg-dark">
                                <th colspan="12" class="text-white">Pos {{ $pos->no_pos }} - {{ $pos->city }} - {{ $kelas->nama_kelas }}</th>
                            </tr>
                            <tr class="bg-info">
                              <th rowspan="2" style="width: 5%;" class="text-white">RANK</th>
                              <th rowspan="2" class="text-white">Nama Peserta</th>
                              <th rowspan="2" class="text-white">Kota</th>
                              <th rowspan="1" colspan="3" class="text-center text-white">Data Burung</th>
                              <th rowspan="2" class="text-white">Jarak (KM)</th>
                              <th rowspan="1" colspan="3" class="text-center text-white">Kedatangan</th>
                              <th rowspan="2" class="text-white">Waktu Terbang</th>
                              <th rowspan="2" class="text-white">Kecepatan</th>
                            </tr>
                            <tr class="bg-info">
                                <th class="text-white">No. Ring</th>
                                <th class="text-white">Warna</th>
                                <th class="text-white">Jenis Kelamin</th>
                                <th class="text-white">Tanggal</th>
                                <th class="text-white">H</th>
                                <th class="text-white">Jam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rank as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->city }}</td>
                                <td>{{ Helper::noRing($item->nama_club, $item->tahun, $item->no_ring) }}</td>
                                <td>{{ $item->warna }}</td>
                                <td>{{ $item->jenkel }}</td>
                                <td>{{ $item->distance }}</td>
                                <td>{{ $item->arrival_date }}</td>
                                <td>{{ $item->arrival_day }}</td>
                                <td>{{ $item->arrival_clock }}</td>
                                <td>{{ $item->flying_time }}</td>
                                <td>{{ $item->velocity }}</td>                              
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
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.bootstrap4.min.css">
@endpush
@push('js_script')
    @include('layouts.datatable-js-assets')
    <script>
        $(document).ready(function() {
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
                        messageTop: 'Data Hasil Pos '+ @JSON($pos->no_pos) + ' - ' + @JSON($pos->city) + ' Kelas ' + @JSON($kelas->nama_kelas),
                    },
                    { 
                        extend: 'excel', 
                        className: 'btn btn-secondary', 
                        text: 'Excel',
                        messageTop: 'Data Hasil Pos '+ @JSON($pos->no_pos) + ' - ' + @JSON($pos->city) + ' Kelas ' + @JSON($kelas->nama_kelas),
                    },
                ],
            });
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