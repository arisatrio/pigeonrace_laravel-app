@extends('layouts.app')
@section('title', 'Tambah Burung')
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
                                    <input type="number" class="form-control" name="no_ring" placeholder="Contoh: 2169">
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
                                        @foreach ($warna as $item)
                                        <option value="{{ $item->kode_warna }}">{{$item->kode_warna}} ({{ $item->warna }})</option>
                                        @endforeach
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
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="titip">
                            <label class="form-check-label" for="flexCheckDefault">
                              Burung Titipan?
                            </label>
                        </div>
                        <div class="row" id="titipan" hidden>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="titipan" placeholder="Nama">
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
                $('#titipan').prop('hidden', false);
            });
        });
    </script>
@endpush