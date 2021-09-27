@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>POS {{ $pos->no_pos }} - {{ $pos->city }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">

            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="{{ route('user.riwayat-pos', $pos->race->id) }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm btn-icon mr-2" href="{{ route('user.home') }}">
                      <i class="fas fa-home"></i> 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn-success btn-sm btn-icon mr-2" href="{{ route('user.basketing-pos', $pos->id) }}">
                        POS {{$pos->no_pos}} - {{$pos->city}}
                    </a>
                </li>
            </ul>

            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-pills mb-3">
                        @foreach ($pos->race->kelas as $item)
                        <li class="nav-item">
                            <a class="nav-link text-white 
                            @if ($item->id === $kelas->id)
                            btn-info
                            @else
                            btn-secondary
                            @endif 
                            btn-sm btn-icon mr-2" href="{{ route('user.pos-kelas-rank', ['id' => $pos->id, 'kelas_id' => $item->id]) }}">
                              {{$item->nama_kelas}}
                            </a>
                        </li>           
                        @endforeach
                    </ul>

                    <table class="table table-striped display-nowrap" cellspacing="0" width="100%" id="table-1">
                        <thead>
                            <tr class="text-center bg-dark">
                                <th colspan="10" class="text-white">Pos {{ $pos->no_pos }} - {{ $pos->city }} - {{$kelas->nama_kelas}}</th>
                            </tr>
                            <tr class="bg-info">
                                <th class="bg-danger text-white all" style="width: 2%;">Rank</th>
                                <th class="text-white all" style="width: 30%;">Burung</th>
                                <th class="text-white none">Jarak</th>
                                <th class="text-white none">Clock</th>
                                <th class="text-white none">H</th>
                                {{-- <th class="text-white none">Jam</th> --}}
                                <th class="text-white none">Waktu Terbang</th>
                                <th class="text-white none">Kecepatan</th>
                                <th class="text-white none">No Stiker</th>
                                <th class="text-white none">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pos->clock as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td @if ($item->user->id === auth()->user()->id)  class="bg-primary text-white" @endif>
                                    {{ Helper::birdName($item, $item->user->name) }}
                                </td>
                                <td><h6>{{ $item->clock->distance }} KM</h6></td>
                                <td><h6>{{ $item->clock->arrival_clock->format('d/m/Y') }} {{ $item->clock->arrival_clock->format('H:i:s') }}</h6></td>
                                <td><h6>+{{ $item->clock->arrival_day }}</h6></td>
                                {{-- <td>{{ $item->clock->arrival_clock->format('H:i:s') }}</td> --}}
                                <td><h6>{{ $item->clock->flying_time }}</h6></td>
                                <td><h6>{{ $item->clock->velocity }} M/Menit</h6></td>
                                <td><h6>{{$item->clock->no_stiker}}</h6></td>
                                <td><h6>
                                    @if ($item->clock->status === 'SAH')
                                        <span class="badge badge-success">{{$item->clock->status}}</span>
                                    @else
                                        <span class="badge badge-warning">DIVALIDASI</span>
                                    @endif
                                </h6></td>
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
            });
        });
    </script>
@endpush