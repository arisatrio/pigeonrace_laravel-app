@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="section-header">
    <h1>{{ $pos->race->nama_race }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Basketing Pos {{ $pos->no_po }} - {{ $pos->city }}</h4>
                </div>
                <div class="card-body">
                    @if (!$burung->isEmpty())
                    <form action="{{ route('user.store-basketing', $pos->id) }}" method="POST">
                        @csrf
                        @foreach ($burung as $item)
                        <div id="accordion">
                            <div class="accordion">
                                <div class="accordion-header">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="burung_id[]" value="{{ $item->id }}">
                                            <b class="form-check-label">{{ Helper::birdName($item, auth()->user()->name) }}</b>
                                        </div>
                                    </div>         
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <button class="btn btn-md btn-success float-right">Kirim</button>
                    </form>
                    @else
                    <div class="alert alert-danger alert-dismissible">
                        Anda belum menambahkan data burung !
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection