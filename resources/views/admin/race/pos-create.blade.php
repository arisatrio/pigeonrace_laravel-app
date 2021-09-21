@extends('layouts.app')
@section('title', 'Tambah Pos')
@section('content')
<div class="section-header">
    <h1>Tambah Data Pos</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.race.create') }}">Buat Race</a></div>
        <div class="breadcrumb-item active"><a href="{{ route('admin.race.show', $race->id) }}">{{ $race->nama_race}}</a></div>
        <div class="breadcrumb-item">Tambah Data Pos</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Pos</h5>
                </div>
                <div class="card-body">

                    @include('layouts.messages-alert')
                    
                    <form action="{{ route('admin.race-pos.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Jenis Lomba <span class="text-danger">*</span></label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" class="selectgroup-input" id="marathon">
                                    <span class="selectgroup-button">Marathon</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" class="selectgroup-input" id="drag">
                                    <span class="selectgroup-button">Drag</span>
                                </label>
                            </div>
                            <div class="w-100" id="limit_day" hidden>
                                <div class="form-group">
                                    <label class="form-label">Limit Hari (H+)</label>
                                    <input type="number" class="form-control" name="limit_day">
                                </div>
                            </div>
                            <div class="w-100" id="limit_speed" hidden>
                                <div class="form-group">
                                    <label class="form-label">Limit Speed (M/Menit)</label>
                                    <input type="number" class="form-control" name="limit_speed">
                                </div>
                            </div>
                        </div>

                        <hr>
                        
                        <div class="form-group">
                            <label for="no_pos">No Pos</label>
                            <input type="number" class="form-control" name="no_pos" required>
                        </div>

                        <div class="form-group">
                            <label for="city">Nama Pos</label>
                            <input type="text" class="form-control" name="city" required>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tgl_inkorv">Tanggal Inkorv</label>
                                    <input type="datetime-local" class="form-control" name="tgl_inkorv" id="tgl_inkorv" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tgl_lepasan">Tanggal Lepasan</label>
                                    <input type="datetime-local" class="form-control" name="tgl_lepasan" id="tgl_lepasan" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Close Time</label>
                                    <input type="time" class="form-control" name="close_time" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Restart Time</label>
                                    <input type="time" class="form-control" name="restart_time" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="latitude">Latitude (S)</label>
                                    <input type="text" class="form-control" name="latitude" id="latitude" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="longitude">Longitude (E)</label>
                                    <input type="text" class="form-control" name="longitude" id="longitude" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="biaya_inkorv">Biaya Inkorv (RP)</label>
                            <input type="number" class="form-control" name="biaya_inkorv" required>
                        </div>

                        <input type="hidden" name="race_id" value="{{ $race->id }}">
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
    $(document).ready(function() {

        $("#longitude").inputmask({
            mask: "99[9]° 99.999'",
        });
        $("#latitude").inputmask({
            mask: "99° 99.999'",
        });

        $('#marathon').change(function() {
            $('#limit_day').prop('hidden', false);
            $('#limit_speed').prop('hidden', true);
        });
        $('#drag').change(function() {
            $('#limit_day').prop('hidden', true);
            $('#limit_speed').prop('hidden', false);
        });
    });
</script>
@endpush