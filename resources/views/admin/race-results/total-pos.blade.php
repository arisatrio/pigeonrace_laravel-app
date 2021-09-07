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
                      <a onclick="goBack()" class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="#">
                        <i class="fas fa-arrow-left"></i>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-white btn-primary btn-sm mr-2" href="#">
                        TOTAL POS
                      </a>
                    </li>
                  </ul>


                  <table class="table table-striped" id="table-1">
                    <thead>
                        <tr class="text-center bg-dark">
                            <th colspan="4" class="text-white">Data Peserta</th>
                            @foreach ($pos as $item)
                            <th colspan="{{$totalPos}}" class="text-white">POS-{{ $item->no_pos }}</th>
                            @endforeach
                            <th colspan="2" class="text-white">TOTAL POS</th>
                        </tr>
                        <tr class="text-center">
                          <th rowspan="2" style="width: 5%;" class="bg-danger text-white">ACE RANK</th>
                          <th rowspan="2" class="bg-info text-white">Nama Peserta</th>
                          <th rowspan="2" class="bg-info text-white">Kota</th>
                          <th rowspan="2" class="bg-info text-white">No. Ring</th>
                          @foreach ($pos as $item)
                          <th rowspan="1" colspan="{{$totalPos}}" class="bg-success text-center text-white">{{ $item->city }}</th>
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
                        @foreach ($coll as $item)
                        <tr>
                            <td class="text-center">{{$loop->iteration}}</td> 
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->user->city }}</td>
                            <td>{{ Helper::noRing($item->club->nama_club, $item->tahun, $item->no_ring) }}</td>
                            @foreach ($item->clock as $key => $pos)
                                @if ($key+1 !== $pos->no_pos)
                                <td class="text-center text-danger"><span class="badge badge-danger">-</span></td>
                                <td class="text-center text-danger"><span class="badge badge-danger">-</span></td>
                                <td class="text-center"><b>{{ $pos->clock->velocity }} M/Menit</b></td>
                                <td class="text-center">{{ Helper::getRankInPos($pos->clock->race_pos_id, $pos->clock->burung_id) }}</td>
                                @elseif($item->clock->count() < $totalPos)
                                <td class="text-center"><b>{{ $pos->clock->velocity }} M/Menit</b></td>
                                <td class="text-center">CEK</td>
                                <td class="text-center">0</td>
                                <td class="text-center">0</td>
                                @else
                                <td class="text-center"><b>{{ $pos->clock->velocity }} M/Menit</b></td>
                                <td class="text-center">CEK</td>
                                @endif
                            @endforeach
                            <td class="text-center">{{ $item->clock->count() }}</td>
                            <td class="text-center"><b>{{ Helper::getAvgSpeed($item->clock) }} M/Menit</b></td>
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
@endpush
@push('js_script')
    @include('layouts.datatable-js-assets')
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable({
                order: [[8, 'desc'], [9, 'desc']]
            });
        });

        function goBack() {
          window.history.back();
        }
    </script>
@endpush