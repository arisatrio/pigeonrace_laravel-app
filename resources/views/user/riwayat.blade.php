@extends('layouts.app')
@section('title', 'Riwayat Race')
@section('content')
<div class="section-header">
    <h1>Riwayat Race</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.home') }}">Home</a></div>
        <div class="breadcrumb-item">Riwayat Race</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <h2 class="section-title">
                Riwayat Race
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
                            <div class="article-cta">
                                <a href="{{ route('user.riwayat-pos', $item->id) }}" class="btn btn-lg btn-primary">Buka</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection