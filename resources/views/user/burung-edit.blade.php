@extends('layouts.app')
@section('title', 'Edit Burung')
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
                    <form action="{{ route('user.burung.update', $burung->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row pb-0">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="club_id">Pilih Club</label>
                                    <select name="club_id" class="form-control">
                                        <option selected disabled>--Pilih Club--</option>
                                        @foreach ($club as $item)
                                        <option @if ($item->id === $burung->club_id) selected @endif value="{{ $item->id }}">{{ $item->nama_club }}</option>
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
                                        <option @if ($item == $burung->tahun) selected @endif value="{{ $item }}">{{ $item }}</option>
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
                                    <input type="number" class="form-control" name="no_ring" value="{{ $burung->no_ring }}">
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
                                        <option @if ($burung->warna === "BB") selected @endif value="BB">BB (Megan)</option>
                                        <option @if ($burung->warna === "BBPD") selected @endif value="BBPD">BBPD (Megan Selap)</option>
                                        <option @if ($burung->warna === "BC") selected @endif value="BC">BC (Tritis)</option>
                                        <option @if ($burung->warna === "VAL") selected @endif value="VAL">VAL (Pal)</option>
                                        <option @if ($burung->warna === "W") selected @endif value="W">W (Putih)</option>
                                        <option @if ($burung->warna === "SL") selected @endif value="SL">SL (Slate)</option>
                                        <option @if ($burung->warna === "RC") selected @endif value="RC">RC (Tritis Merah)</option>
                                        <option @if ($burung->warna === "BCWP") selected @endif value="BCWP">BCWP (Tritis Slap)</option>
                                        <option @if ($burung->warna === "ZK") selected @endif value="ZK">ZK (Tritis Gelap)</option>
                                        <option @if ($burung->warna === "D") selected @endif value="D">D (Hitam)</option>
                                        <option @if ($burung->warna === "GZ") selected @endif value="GZ">GZ (Grizzle)</option>
                                        <option @if ($burung->warna === "BP") selected @endif value="BP">BP (Megan Slap)</option>
                                        <option @if ($burung->warna === "RED") selected @endif value="RED">RED (Merah)</option>
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
                                        <option @if ($burung->jenkel === "JANTAN") selected @endif value="JANTAN">Jantan</option>
                                        <option @if ($burung->jenkel === "BETINA") selected @endif value="BETINA">Betina</option>
                                    </select>
                                    @error('jenkel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="titip" @if ($burung->titipan) checked @endif>
                            <label class="form-check-label" for="flexCheckDefault">
                              Burung Titipan?
                            </label>
                        </div>
                        <div class="row" id="titipanrow" @if (!$burung->titipan) hidden @endif>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="titipan" name="titipan" value="{{$burung->titipan}}">
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
@push('js_script')
    <script>
        $(document).ready(function() {
            $('#titip').change(function() {
                $('#titipan').val('');
                $('#titipanrow').prop('hidden', false);
            });
        });
    </script>
@endpush