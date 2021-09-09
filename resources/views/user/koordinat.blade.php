@extends('layouts.app')
@section('title', 'Koordinat')
@section('content')
<div class="section-header">
    <h1>Data Koordinat</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('user.home') }}">Home</a></div>
        <div class="breadcrumb-item">Data Koordinat</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            @if (session('messages'))
            <div class="alert alert-success alert-dismissible">
                {{ session('messages') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible">
                @foreach ($errors->all() as $error)
                    {{$error}} <br>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            
            @if ($user->latitude == null)
            <div class="alert alert-danger alert-dismissible">
                Anda belum setting Koordinat.
            </div>
            @endif
            <div class="card">
                <form action="{{ route('user.profile.update', $user->id) }}" method="POST" accept-charset="UTF-8">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('components.select-city', ['selectedCity' => $user->city])
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="latitude" class="control-label">Latitude (S)</label>
                                    <input id="latitude" type="text" class="form-control" name="latitude" value="{{ $user->latitude }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="longitude" class="control-label">Longitude (E)</label>
                                    <input id="longitude" type="text" class="form-control" name="longitude" value="{{ $user->longitude }}" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="float-right btn btn-primary mt-4 mb-4">Simpan</button>
                    </div>
                </form>
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