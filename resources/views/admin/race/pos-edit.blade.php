@extends('layouts.app')
@section('title', 'Edit Pos')
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

                    <form action="{{ route('admin.race-pos.update', $pos->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <div class="form-group">
                                @if (!$pos->limit_speed)
                                <label class="form-label">Limit Hari (H+)</label>
                                <input type="number" class="form-control" name="limit_day" value="{{$pos->limit_day}}">
                                @else
                                <label class="form-label">Limit Speed (M/Menit)</label>
                                <input type="number" class="form-control" name="limit_speed" value="{{$pos->limit_speed}}">
                                @endif
                            </div>
                        </div>

                        <hr>
                        
                        <div class="form-group">
                            <label for="no_pos">No Pos</label>
                            <input type="number" class="form-control" name="no_pos" value="{{ $pos->no_pos }}">
                        </div>

                        <div class="form-group">
                            <label for="city">Nama Pos</label>
                            <input type="text" class="form-control" name="city" value="{{ $pos->city }}">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tgl_inkorv">Tanggal Inkorv</label>
                                    <input type="datetime-local" class="form-control" name="tgl_inkorv" value="{{ $pos->tgl_inkorv->format('Y-m-d').'T'.$pos->tgl_inkorv->format('H:i:s') }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="tgl_lepasan">Tanggal Lepasan</label>
                                    <input type="datetime-local" class="form-control" name="tgl_lepasan" id="tgl_lepasan" value="{{ $pos->tgl_lepasan->format('Y-m-d').'T'.$pos->tgl_lepasan->format('H:i:s') }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Close Time</label>
                                    <input type="time" class="form-control" name="close_time" value="{{ $pos->close_time->format('H:i:s')}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Restart Time</label>
                                    <input type="time" class="form-control" name="restart_time" value="{{ $pos->restart_time->format('H:i:s')}}">
                                </div>
                            </div>
                        </div>

                        {{-- Select2 City --}}
                        {{-- @include('components.select-city') --}}

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="latitude">Latitude (S)</label>
                                    <input type="text" class="form-control" name="latitude" id="latitude" value="{{ $pos->latitude }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="longitude">Longitude (E)</label>
                                    <input type="text" class="form-control" name="longitude" id="longitude" value=" {{ $pos->longitude }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="biaya_inkorv">Biaya Inkorv</label>
                            <input type="number" class="form-control" name="biaya_inkorv" value="{{ $pos->biaya_inkorv }}">
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
    $("#longitude").inputmask({
        mask: "99[9]° 99.999'",
    });
    $("#latitude").inputmask({
        mask: "99° 99.999'",
    });
</script>
@endpush