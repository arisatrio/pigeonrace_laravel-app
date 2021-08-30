@extends('layouts.app')
@section('title', 'Race')
@section('content')
<div class="section-header">
    <h1>{{ $race->nama_race }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">

            @if (session('messages'))
            <div class="alert alert-success alert-dismissible">
                {{ session('messages') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @foreach ($race->pos as $item)
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('user.pos-mode', $item->id) }}" class="text-primary"><h6>POS {{ $item->no_pos }} - {{ $item->city }}</h6></a>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection