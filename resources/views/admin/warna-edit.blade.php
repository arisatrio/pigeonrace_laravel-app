@extends('layouts.app')
@section('title', 'Edit Data Warna Burung')
@section('content')
<div class="section-header">
    <h1>Edit Data Warna</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.warna.index') }}">Data Warna</a></div>
        <div class="breadcrumb-item">Data Warna</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('layouts.messages-alert')
                    
                    <form action="{{ route('admin.warna.update', $warna->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="warna">Kode Warna</label>
                                    <input type="text" class="form-control" name="kode_warna" value="{{$warna->kode_warna}}">
                                    @error('kode_warna')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="warna">Warna</label>
                                    <input type="text" class="form-control" name="warna" value="{{$warna->warna}}">
                                    @error('warna')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="float-right btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection