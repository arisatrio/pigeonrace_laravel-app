@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>POS {{ $pos->no_pos }} - {{ $pos->city }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">

            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a onclick="goBack()" class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="#home3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm btn-icon mr-2" href="#home3">
                      <i class="fas fa-home"></i> 
                    </a>
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
                    <table class="table table-striped display-nowrap" id="table-1">
                        <thead>
                            <tr class="text-center bg-dark">
                                <th colspan="7" class="text-white">Pos {{ $pos->no_pos }} - {{ $pos->city }}</th>
                            </tr>
                            <tr class="bg-info">
                                <th rowspan="2" class="text-white">Rank</th>
                                <th rowspan="2" class="text-white">Burung</th>
                                <th rowspan="2" class="text-white">Kecepatan</th>
                                <th rowspan="2" class="text-white">Jarak</th>
                                <th rowspan="1" colspan="4" class="text-white">Clock</th>
                                <th rowspan="2" class="text-white">Status</th>
                            </tr>
                            <tr class="bg-info">
                                <th class="text-white">Tanggal</th>
                                <th class="text-white">H</th>
                                <th class="text-white">Jam</th>
                                <th class="text-white">Waktu Terbang</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rank as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td @if ($item->user->id === auth()->user()->id)  class="bg-primary" @endif>
                                    {{ Helper::birdName($item, $item->user->name) }}
                                </td>
                                <td>{{ $item->clock->velocity }} M/Menit</td>
                                <td>{{ $item->clock->distance }} KM</td>
                                <td>{{ $item->clock->arrival_clock->format('d/m/Y') }}</td>
                                <td>{{ $item->clock->arrival_day }}</td>
                                <td>{{ $item->clock->arrival_clock->format('H:i:s') }}</td>
                                <td>{{ $item->clock->flying_time }}</td>
                                <td>
                                    @if ($item->clock->status === null)
                                        <span class="bagde badge-warning">BELUM DIVALIDASI</span>
                                    @elseif ($item->clock->status === 'SAH')
                                        <span class="badge badge-success">{{ $item->clock->status}}</span>
                                    @elseif ($item->clock->status === 'TIDAK SAH')
                                        <span class="badge badge-danger">{{ $item->clock->status}}</span>
                                    @endif
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
                rowReorder: {
                    selector: 'td:nth-child(1)'
                },
                responsive: true,
            });
        });
        function goBack() {
          window.history.back();
        }
    </script>
@endpush