@extends('layouts.app-user')

@section('content')
<div class="section-header">
    <h1>Data Burung</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('superadmin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Data Burung</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="mb-4">
                <a href="{{ route('user.burung.create') }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Add Data"><i class="fas fa-plus"></i> Add Data</a>
            </div>
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
                    @foreach ($burung as $item)
                    <div id="accordion">
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-{{$item->id}}">
                                <b>{{ $item->club->nama_club }}-{{ $item->tahun }}-{{ $item->no_ring }}-{{ $item->jenkel }}-{{ $item->warna }}-{{ $item->user->name }}</b>
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