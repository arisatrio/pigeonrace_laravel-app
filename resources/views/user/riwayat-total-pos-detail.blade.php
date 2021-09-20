@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>{{ $race->nama_race }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">

            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="{{ route('user.riwayat-pos', $race->id) }}">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm btn-icon mr-2" href="{{ route('user.home') }}">
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
                <div class="card-header">
                    <h4>Profile Burung</h4>
                </div>
                <div class="card-body">
                    <p class="mb-0"><b>Nama Pemilik</b></p>
                    <p>{{ $burung->user->name }}</p>
                    <p class="mb-0"><b>No. Ring</b></p>
                    <p>{{ Helper::noRing($burung->club->nama_club, $burung->tahun, $burung->no_ring) }}</p>
                    <p class="mb-0"><b>Warna</b></p>
                    <p>{{ $burung->warna }}</p>
                    <p class="mb-0"><b>Jenis Kelamins</b></p>
                    <p>{{ $burung->jenkel }}</p>
                </div>
            </div>

            @foreach ($burung->clockModel as $item)
            <div class="card">
                <div class="card-header">
                    <h4>Pos {{ $item->pos->no_pos }} - {{ $item->pos->city }}</h4>
                </div>
                <div class="card-body">
                    <p class="mb-0"><b>Koordinat Lepasan</b></p>
                    <p>{{ $item->pos->latitude }}, {{ $item->pos->longitude }}</p>
                    <p class="mb-0"><b>Tanggal dan Jam Lepasan</b></p>
                    <p>{{ $item->pos->tgl_lepasan->locale('id')->isoFormat('LLLL') }}</p>
                    <p class="mb-0"><b>Jarak Pos ke Kandang (KM)</b></p>
                    <p>{{ $item->distance }}</p>
                    <p class="mb-0"><b>Tanggal Kedatangan</b></p>
                    <p>{{ $item->arrival_date->format('d/m/Y') }}</p>
                    <p class="mb-0"><b>H</b></p>
                    <p>{{ $item->arrival_day }}</p>
                    <p class="mb-0"><b>Jam Kedatangan</b></p>
                    <p>{{ $item->arrival_clock->format('H:i:s') }}</p>
                    <p class="mb-0"><b>Waktu Terbang</b></p>
                    <p>{{ $item->flying_time }}</p>
                    <p class="mb-0"><b>Kecepatan</b></p>
                    <p>{{ $item->velocity }} M/Menit</p>
                </div>
            </div>                
            @endforeach

        </div>
    </div>
</div>
@endsection