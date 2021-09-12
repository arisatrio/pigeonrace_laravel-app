@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>TOTAL POS</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">

            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a onclick="goBack()" class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="#">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm btn-icon mr-2" href="{{ route('user.home') }}">
                      <i class="fas fa-home"></i> 
                    </a>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-danger text-white mr-2">
                        TOTAL POS - {{ $race->nama_race }}
                    </button>
                </li>
                <li class="nav-item">
                    <button type="button" class="btn btn-info text-white">
                        {{ $kelas->nama_kelas }}
                    </button>
                </li>
            </ul>

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

                    <div class="row mb-4">
                        <div class="col">
                            @foreach ($race->kelas as $item)
                            <a class="btn btn-info text-white" href="{{ route('user.total-pos-kelas', ['race_id' => $race->id, 'kelas_id' => $item->id]) }}">
                                {{ $item->nama_kelas }}
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <table class="table table-striped display" cellspacing="0" width="100%" id="table-1">
                        <thead>
                            <tr class="text-center bg-dark">
                                <th colspan="9" class="text-white">TOTAL POS</th>
                            </tr>
                            <tr class="bg-info">
                                <th class="text-white text-center all bg-danger" style="width: 5%;">ACE RANK</th>
                                <th class="text-white text-center all" style="width: 40%;">Burung</th>
                                <th class="text-white text-center none">Total Speed</th>
                                <th class="text-white text-center none">Total Clock</th>
                                <th class="text-white text-center none">Kecepatan Rata-Rata</th>
                                <th class="text-white none"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clock as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center @if ($item->user_id === auth()->user()->id) bg-primary text-white @endif">{{ Helper::birdName($item, $item->user->name) }}</td>
                                <td class="text-center">{{ Helper::getTotalSpeed($item->clockModel) }} M/Menit</td>
                                <td class="text-center">{{ $item->clockModel->count() }}</td>
                                <td class="text-center">{{ Helper::getAvgSpeed($item->clockModel) }} M/Menit</td>
                                <td style="width: 5%;">
                                    <a href="{{ route('user.total-pos-detail', ['race_id' => $race->id, 'burung_id' => $item->id]) }}" class="btn btn-success">
                                        Lihat Detail
                                    </a>
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
@endsection
@push('css_script')
    @include('layouts.datatable-css-assets')
@endpush
@push('js_script')
    @include('layouts.datatable-js-assets')
    <script>
        $(document).ready(function() {
            $('#table-1').DataTable({  
                responsive: true,
                order: [[2, 'desc'], [4, 'desc']]
            });
        });
        function goBack() {
          window.history.back();
        }
    </script>
@endpush