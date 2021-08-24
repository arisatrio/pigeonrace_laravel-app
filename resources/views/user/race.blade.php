@extends('layouts.app')
@section('title', 'Race')
@section('content')
<div class="section-header">
    <h1>Race</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.home') }}">Home</a></div>
        <div class="breadcrumb-item">Race</div>
    </div>
</div>
@if (auth()->user()->latitude == null)
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible">
                Anda belum setting Koordinat!.
            </div>
        </div>
    </div>
</div>
@else
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <h2 class="section-title">
                Jadwal Race
            </h2>
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
        </div>
    </div>
</div>
@endif
@endsection