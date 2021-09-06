@extends('layouts.app')

@section('content')
<div class="section-header">
    <h1>Buat Race</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Buat Race</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Race</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.race.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_race">Nama Race</label>
                                    <input type="text" class="form-control" name="nama_race" required>
                                    @error('nama_race')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tgl_race">Tanggal Race</label>
                                    <input type="date" class="form-control" name="tgl_race" required>
                                    @error('tgl_race')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                <label for="">Poster Race</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="poster" required>
                                        <label for="poster" class="custom-file-label">Pilih File</label>
                                        @error('poster')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="5" style="height:100%;" required></textarea>
                            @error('deskripsi')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class=" mt-4 float-right btn btn-block btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js_script')
<script>
    $('input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $(e.target).siblings('.custom-file-label').html(fileName);
    });
</script>
@endpush
