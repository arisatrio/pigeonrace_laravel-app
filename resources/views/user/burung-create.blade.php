@extends('layouts.app-user')

@section('content')
<div class="section-header">
    <h1>Tambah Data Burung</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.home') }}">Home</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('user.burung.index') }}">Data Burung</a></div>
        <div class="breadcrumb-item">Tambah Data Burung</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.burung.store') }}" method="POST">
                        @csrf
                        <div class="row pb-0">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="club_id">Pilih Club</label>
                                    <select name="club_id" class="form-control">
                                        <option selected disabled>--Pilih Club--</option>
                                        @foreach ($club as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_club }}</option>
                                        @endforeach
                                    </select>
                                    @error('club_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun">Pilih Tahun</label>
                                    <select name="tahun" class="form-control">
                                        <option selected disabled>--Pilih Tahun--</option>
                                        @foreach ($tahun as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('tahun')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_ring">No Ring</label>
                                    <input type="no_ring" class="form-control" name="no_ring" placeholder="Contoh: 2169">
                                    @error('no_ring')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="warna">Pilih Warna</label>
                                    <select name="warna" class="form-control">
                                        <option selected disabled>--Pilih Warna--</option>
                                        <option value="BB">BB (Megan)</option>
                                        <option value="BBPD">BBPD (Megan Selap)</option>
                                        <option value="BC">BC (Tritis)</option>
                                        <option value="VAL">VAL (Pal)</option>
                                        <option value="W">W (Putih)</option>
                                        <option value="SL">SL (Slate)</option>
                                        <option value="RC">RC (Tritis Merah)</option>
                                        <option value="BCWP">BCWP (Tritis Slap)</option>
                                        <option value="ZK">ZK (Tritis Gelap)</option>
                                        <option value="D">D (Hitam)</option>
                                        <option value="GZ">GZ (Grizzle)</option>
                                        <option value="BP">BP (Megan Slap)</option>
                                        <option value="RED">RED (Merah)</option>
                                    </select>
                                    @error('warna')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenkel">Pilih Jenis Kelamin</label>
                                    <select name="jenkel" class="form-control">
                                        <option selected disabled>--Pilih Jenis Kelamin--</option>
                                        <option value="JANTAN">Jantan</option>
                                        <option value="BETINA">Betina</option>
                                    </select>
                                    @error('jenkel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <button type="submit" class="float-right btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection