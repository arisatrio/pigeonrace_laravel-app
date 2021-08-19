@extends('layouts.app')
@section('title', 'Detail Lomba')
@section('content')
<div class="section-header">
    <h1>{{ $race->nama_race }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.home') }}">Home</a></div>
        <div class="breadcrumb-item">{{ $race->nama_race }}</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('assets/img/poster'.$race->poster) }}" class="img-fluid">
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Jadwal Latihan</h4>
                </div>
                <div class="card-body">
                    @php $no = 1 @endphp
                    @foreach ($race->latihan as $item)
                    <div id="accordion">
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-latihan-{{$no}}" aria-expanded="true">
                                <h4>{{ $no }} - {{ $item->city }}</h4>
                            </div>
                            <div class="accordion-body show" id="panel-latihan-{{$no++}}" data-parent="#accordion" style="">
                                <p class="mb-0"><b>Tanggal Inkorv</b> :</p>
                                <p>{{ $item->tgl_inkorv->locale('id')->isoFormat('LLLL') }}</p>
                                <p class="mb-0"><b>Tanggal Lepasan</b> :</p>
                                <p>{{ $item->tgl_lepasan->locale('id')->isoFormat('LLLL') }}</p>
                                <p class="mb-0"><b>Biaya Inkorv</b></p>
                                <p>Rp. {{ number_format($item->biaya_inkorv) }}</p>
                                <p class="mb-0"><b>Biaya Lomba</b></p>
                                <ul>
                                    @foreach ($race->kelas as $item2)
                                    <li><b>{{ $item2->nama_kelas }}</b> : Rp. {{ number_format($item2->biaya) }}</li>
                                    @endforeach
                                </ul>
                                <p class="mb-0"><b>Koordinat :</b></p>
                                <p>{{ $item->latitude }}, {{ $item->longitude }}</p>
                                <p class="mb-0"><b>Jarak Pos ke Kandang</b> :</p>
                                <p>{{ Helper::calculateDistance(auth()->user()->latitude, auth()->user()->longitude, $item->latitude, $item->longitude) }}</p>
                            </div>
                        </div>
                    </div>             
                    @endforeach
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Jadwal Race</h4>
                </div>
                <div class="card-body">
                    @php $no = 1 @endphp
                    @foreach ($race->pos as $item)
                    <div id="accordion">
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-{{$no}}" aria-expanded="true">
                                <h4>Pos {{ $no }} - {{ $item->city }}</h4>
                            </div>
                            <div class="accordion-body show" id="panel-body-{{$no++}}" data-parent="#accordion" style="">
                                <p class="mb-0"><b>Tanggal Inkorv</b> :</p>
                                <p>{{ $item->tgl_inkorv->locale('id')->isoFormat('LLLL') }}</p>
                                <p class="mb-0"><b>Tanggal Lepasan</b> :</p>
                                <p>{{ $item->tgl_lepasan->locale('id')->isoFormat('LLLL') }}</p>
                                <p class="mb-0"><b>Biaya Inkorv</b></p>
                                <p>Rp. {{ number_format($item->biaya_inkorv) }}</p>
                                <p class="mb-0"><b>Biaya Lomba</b></p>
                                <ul>
                                    @foreach ($race->kelas as $item2)
                                    <li><b>{{ $item2->nama_kelas }}</b> : Rp. {{ number_format($item2->biaya) }}</li>
                                    @endforeach
                                </ul>
                                <p class="mb-0"><b>Koordinat :</b></p>
                                <p>{{ $item->latitude }}, {{ $item->longitude }}</p>
                                <p class="mb-0"><b>Jarak Pos ke Kandang</b> :</p>
                                <p>{{ Helper::calculateDistance(auth()->user()->latitude, auth()->user()->longitude, $item->latitude, $item->longitude) }}</p>
                            </div>
                        </div>
                    </div>             
                    @endforeach
                </div>
            </div>

            <form action="{{ route('user.join-race', $race->id) }}" method="POST">
                @csrf
                <button class="btn btn-block btn-primary">Ikuti</button>
            </form>
        </div>
    </div>
</div>
@endsection