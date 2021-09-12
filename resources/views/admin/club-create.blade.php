@extends('layouts.app')
@section('title', 'Tambah Data Club')
@section('content')
<div class="section-header">
    <h1>Tambah Data Club</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.club.index') }}">Data Club</a></div>
        <div class="breadcrumb-item">Data Club</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @include('layouts.messages-alert')
                    
                    <form action="{{ route('admin.club.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama_club">Nama Club</label>
                                    <input type="text" class="form-control" name="nama_club">
                                    @error('nama_club')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                @include('components.select-city')
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_center">No. Center</label>
                                    <input type="no_center" class="form-control" name="no_center">
                                    @error('no_center')
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