@extends('layouts.app')
@section('title', 'Home')
@section('content')

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
                Anda belum setting Koordinat. Silahkan Setting Koordinat terlebih dahulu untuk melihat dan mengikuti lomba.
            </div>
            @endif
            
        </div>
    </div>

    <h2 class="section-title">
        Race Di Ikuti
    </h2>
    @isset($raceJoined)
    @foreach ($raceJoined as $item)
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
                        <a href="{{ route('user.race-mode', $item->id) }}" class="btn btn-lg btn-primary">Buka</a>
                    </div>
                </div>
            </article>
        </div>
    </div>
    @endforeach
    @endisset

    <hr>
    <h2 class="section-title">
        Jadwal Race
    </h2>
    @if (auth()->user()->latitude != null)
        @isset($raceJoined)
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
                            <a href="{{ route('user.race.show', $item->slug) }}" class="btn btn-lg btn-primary">Lihat Detail Lomba</a>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        @endforeach
        @endisset
    @endif

</div>
@endsection