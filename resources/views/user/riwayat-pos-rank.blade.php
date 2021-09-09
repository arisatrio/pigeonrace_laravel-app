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
                    
                    {{-- <div id="accordion">
                        <div class="list-group">
                          <div class="list-group-item" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                            <h4>(1)</h4>
                          </div>
                          <div class="card-body collapse show" id="panel-body-1" data-parent="#accordion" style="">
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                          </div>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                              <h4>(1)</h4>
                            </div>
                            <div class="card-body collapse show" id="panel-body-1" data-parent="#accordion" style="">
                              <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                              cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                              proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                          </div>
                        
                    </div> --}}

                    <table class="table table-striped display" cellspacing="0" width="100%" id="table-1">
                        <thead>
                            <tr class="text-center bg-dark">
                                <th colspan="9" class="text-white">Pos {{ $pos->no_pos }} - {{ $pos->city }}</th>
                            </tr>
                            <tr class="bg-info">
                                <th class="text-white all" style="width: 2%;">Rank</th>
                                <th class="text-white all" style="width: 30%;">Burung</th>
                                <th class="text-white none">Jarak</th>
                                <th class="text-white none">Tanggal</th>
                                <th class="text-white none">H</th>
                                <th class="text-white none">Jam</th>
                                <th class="text-white none">Waktu Terbang</th>
                                <th class="text-white none">Kecepatan</th>
                                <th class="text-white none" style="width: 5%;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rank as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td @if ($item->user->id === auth()->user()->id)  class="bg-primary text-white" @endif>
                                    {{ Helper::birdName($item, $item->user->name) }}
                                </td>
                                <td>{{ $item->clock->distance }} KM</td>
                                <td>{{ $item->clock->arrival_clock->format('d/m/Y') }}</td>
                                <td>{{ $item->clock->arrival_day }}</td>
                                <td>{{ $item->clock->arrival_clock->format('H:i:s') }}</td>
                                <td>{{ $item->clock->flying_time }}</td>
                                <td><b>{{ $item->clock->velocity }} M/Menit</b></td>
                                <td style="width: 5%;">
                                    @if ($item->clock->status === null)
                                        <span class="badge badge-warning">BELUM DIVALIDASI</span>
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
                responsive: true,
            });
        });
        function goBack() {
          window.history.back();
        }
    </script>
@endpush