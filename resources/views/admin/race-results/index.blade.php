@extends('layouts.app')

@section('content')
<div class="section-header">
    <h1>Hasil Race</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Hasil Race</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        
        @foreach ($race as $item)
        <div class="col-4">
            <a href="{{ route('admin.race-results.show', $item->id) }}" class="text-white">
                <article class="article">
                    <div class="article-header">
                        <div class="article-image" data-background="{{ asset('assets/img/poster/'.$item->poster) }}"></div>
                        <div class="article-title">
                            <h2>{{ $item->nama_race }}</h2>
                        </div>
                    </div>
                </article>
            </a>
        </div>
        @endforeach
        
    </div>
</div>
@endsection
