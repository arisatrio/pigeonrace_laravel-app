@extends('layouts.app')
@section('title', 'Home')
@section('content')

@if ($isUserJoin === false)
    <div class="section-header">
        <h1>Home</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
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
                @if (auth()->user()->latitude == null)
                <div class="alert alert-danger alert-dismissible">
                    Anda belum setting Koordinat.
                </div>
                @endif
                <div class="alert alert-danger alert-dismissible">
                    Tidak ada Race di ikuti.
                </div>
            </div>
        </div>
        <hr>
        <h2 class="section-title">
            Jadwal Race
        </h2>
        @if (auth()->user()->latitude != null)
            @foreach ($race as $item)
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image" data-background="{{ asset('assets/img/poster/'.$item->poster) }}"></div>
                            <div class="article-title">
                                <h2><a href="#">{{ $item->nama_race }}</a></h2>
                            </div>
                        </div>
                        <div class="article-details">
                            <small><b> {{ $item->tgl_race->diffForHumans() }} </b></small>
                            <p>{{ $item->deskripsi }}</p>
                            <div class="article-cta">
                                <a href="{{ route('user.race.show', $item->id) }}" class="btn btn-lg btn-primary">Lihat Detail Lomba</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            @endforeach
        @endif
    </div>
@else
<div class="section-header">
    <h1>{{ $r->nama_race }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary mr-3" href="#"><i class="fas fa-stopwatch"></i></a>
                    <h4>Basketing</h4>
                </div>
                <div class="collapse" id="mycard-collapse" style="">
                    <div class="card-body">
                        @php $no = 1 @endphp
                        @foreach ($r->pos as $item)
                        <div id="accordion">
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-{{$no}}" aria-expanded="false">
                                    <h4>Pos {{ $no }} - {{ $item->city }}</h4>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-{{$no++}}" data-parent="#accordion" style="">
                                    <h5>KK-SGM21-3232-VAL-J / {{ auth()->user()->name }}</h5>
                                    <hr>
                                    <h5>KK-SGM21-3232-VAL-J / {{ auth()->user()->name }}</h5>
                                    <hr>
                                    <a href="" class="btn btn-success"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>             
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary mr-3" href="#"><i class="fas fa-plus"></i></a>
                    <h4>Estimasi</h4>
                </div>
                <div class="collapse" id="mycard-collapse" style="">
                    <div class="card-body">
                        You can show or hide this card.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary mr-3" href="#"><i class="fas fa-plus"></i></a>
                    <h4>Clock</h4>
                </div>
                <div class="collapse" id="mycard-collapse" style="">
                    <div class="card-body">
                        You can show or hide this card.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <a data-collapse="#mycard-collapse" class="btn btn-icon btn-primary mr-3" href="#"><i class="fas fa-plus"></i></a>
                    <h4>Hasil</h4>
                </div>
                <div class="collapse" id="mycard-collapse" style="">
                    <div class="card-body">
                        You can show or hide this card.
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endif

@endsection