@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>{{ $race->nama_race }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.race-results.index') }}">Hasil Race</a></div>
        <div class="breadcrumb-item"><a href="{{ route('admin.race-results.show', $race->id) }}">{{ $race->nama_race }}</a></div>
        <div class="breadcrumb-item">TOTAL POS</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item">
                            <a class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="{{ route('admin.race-results.show', $race->id) }}">
                                <i class="fas fa-arrow-left"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-danger text-white mr-2">
                                TOTAL POS - {{ $race->nama_race }}
                            </button>
                        </li>
                    </ul>

                    <ul class="nav nav-pills mb-3">
                        @foreach ($race->kelas as $item)
                            <li class="nav-item">
                                <a class="nav-link btn 
                                @if ($item->id === $kelas->id)
                                btn-info
                                @else
                                btn-secondary
                                @endif
                                text-white mr-2" href="{{ route('admin.total-pos-kelas', ['race_id' => $race->id, 'kelas_id' => $item->id]) }}">
                                    {{ $item->nama_kelas }}
                                </a>
                            </li>
                        @endforeach
                    </ul>


                  <table class="table table-striped" id="table-1">
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
                          <th rowspan="1" colspan="2" class="bg-success text-center text-white">{{ $item->city }}</th>
                          @endforeach
                          <th rowspan="2" class="bg-warning text-white">Clock</th>
                          <th rowspan="2" class="bg-warning text-white" style="width: 5%;">Kecepatan Rata-rata</th>
                        </tr>
                        <tr class="text-center">
                            @for ($i = 0; $i < $totalPos; $i++)
                            <th class="bg-info text-white">Velocity</th>
                            <th class="bg-info text-white">Rank</th>
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
                    </tbody>
                </table>

                
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
            var t = $('#table-1').DataTable({
                order: [[5+(@JSON($totalPos)*2), 'desc'], [4+(@JSON($totalPos)*2), 'desc']],
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
                        messageTop: 'Hasil Total Pos '+ @JSON($race->nama_race) + ' Kelas ' + @JSON($kelas->nama_kelas),
                    },
                    { 
                        extend: 'excel', 
                        className: 'btn btn-secondary', 
                        text: 'Excel',
                        messageTop: 'Hasil Total Pos '+ @JSON($race->nama_race) + ' Kelas ' + @JSON($kelas->nama_kelas),
                    },
                ],
            });
            t.column(0).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        });
    </script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
@endpush