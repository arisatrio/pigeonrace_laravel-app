@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>Basketing POS {{ $pos->no_pos }} - {{ $pos->city }}</h1>
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
                    <a class="nav-link text-white btn-warning btn-sm btn-icon mr-2" href="{{ route('user.basketing-pos', $pos->id) }}">
                        Basketing POS {{$pos->no_pos}} - {{$pos->city}}
                    </a>
                </li>
            </ul>

            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-pills mb-3">
                        @foreach ($pos->race->kelas as $item)
                        <li class="nav-item">
                            <a class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="{{ route('user.basketing-kelas', ['id' => $pos->id, 'kelas_id' => $item->id]) }}">
                                {{$item->nama_kelas}}
                            </a>
                        </li>                 
                        @endforeach
                    </ul>

                    <table class="table table-striped display-nowrap" cellspacing="0" width="100%" id="table-1">
                        <thead>
                            <tr class="text-center bg-dark">
                                <th class="text-white" colspan="7">Basketing Pos {{ $pos->no_pos }} - {{ $pos->city }}</th>
                            </tr>
                            <tr class="bg-warning">
                                <th style="width: 5%;" class="text-white">No</th>
                                <th class="text-white all">Burung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($burung as $bur)
                            
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    {{$bur->club->nama_club}}{{substr($bur->tahun, -2)}}-{{$bur->no_ring}}-{{$bur->jenkel}}-{{$bur->warna}} / {{$bur->user->name}} @if($bur->titipan) - {{$bur->titipan}} @endif
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