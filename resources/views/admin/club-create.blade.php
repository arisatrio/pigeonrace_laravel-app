@extends('layouts.app')

@section('content')
<div class="section-header">
    <h1>Data Club</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">Data Club</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('admin.club.create') }}" class="btn btn-success btn-sm" data-toggle="tooltip" title="Add Data">
                        <i class="fas fa-plus"></i> Add Data
                    </a>
                </div>
                <div class="card-body">
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
                                <div class="form-group">
                                    <label for="city">Pilih Kota</label>
                                    <select name="city" class="form-control">
                                        <option selected disabled>--Pilih Kota--</option>
                                        @foreach ($city as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
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