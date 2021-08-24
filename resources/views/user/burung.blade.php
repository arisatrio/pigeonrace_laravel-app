@extends('layouts.app')
@section('title', 'Data Burung')
@section('content')
<div class="section-header">
    <h1>Data Burung</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.home') }}">Home</a></div>
        <div class="breadcrumb-item">Data Burung</div>
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
            <div class="card">
                <div class="card-header">
                    <h4>Data Burung</h4>
                </div>
                <div class="card-body">
                    <a href="{{ route('user.burung.create') }}" class="btn btn-success btn-md mb-4" data-toggle="tooltip" title="Tambah Burung"><i class="fas fa-plus"></i> Tambah Burung</a>
                    @foreach ($burung as $item)
                    <div id="accordion">
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-{{$item->id}}">
                                <b>{{ Helper::birdName($item, auth()->user()->name) }}</b>
                            </div>
                            <div class="accordion-body collapse" id="panel-body-{{$item->id}}" data-parent="#accordion">
                                <a href="{{ route('user.burung.edit', $item->id) }}" class="btn btn-icon btn-primary">Edit</a>
                                <form class="btn" action="{{ route('user.burung.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-danger">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection