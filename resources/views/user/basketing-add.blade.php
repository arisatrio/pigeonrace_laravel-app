@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="section-header">
    <h1>{{ $pos->race->nama_race }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Basketing Pos {{ $pos->no_pos }} - {{ $pos->city }}</h4>
                </div>
                <div class="card-body">

                    <form action="{{ route('user.store-basketing', $pos->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tambah Burung Basketing</label>
                            <select name="burung_id" class="form-control select2" id="burung" required>
                                <option selected disabled>--Pilih Burung--</option>
                                @foreach ($burung as $item)
                                <option value="{{ $item->id }}">{{ Helper::birdName($item, auth()->user()->name) }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="kelas_id" class="form-control select2" id="kelas" required>
                                <option selected disabled>--Pilih Kelas--</option>
                                @foreach ($pos->race->kelas as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success btn-icon float-right mb-4" id="btn" hidden>Tambah Burung</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css_script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@push('js_script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#burung').select2();
            $('#kelas').select2();
            $('#kelas').change(function() {
                $('#btn').prop('hidden', false);
            });
        });
    </script>
@endpush