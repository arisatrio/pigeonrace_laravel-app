@extends('layouts.app')
@section('title', 'Race')
@section('content')
<div class="section-header">
    <h1>POS {{ $pos->no_pos }} - {{ $pos->city }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">

            <ul class="nav nav-pills mb-3">
                <li class="nav-item">
                    <a onclick="goBack()" class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="#">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm btn-icon mr-2" href="{{ route('user.home') }}">
                      <i class="fas fa-home"></i> 
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn-danger btn-sm btn-icon mr-2" href="{{ route('user.pos-rank', $pos->id) }}">
                        <i class="fas fa-flag-checkered"></i>
                        Cek Hasil Race
                    </a>
                </li>
            </ul>

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

            
            {{-- CLOCK --}}
            <div class="card">
                <div class="card-header">
                    <h4>Clock</h4>
                </div>
                <div class="card-body">
                    @if ($now->lessThan($limit))
                        @if ($now->greaterThanOrEqualTo($pos->tgl_lepasan))
                        <p class="mb-0 text-center">Waktu Terbang</p>
                        <h2 id="span" class="text-center mb-4"></h2>
                        <p class="mb-0"><b>Tanggal dan Jam Lepasan</b> :</p>
                        <p>{{ $pos->tgl_lepasan->isoFormat('LLLL') }}</p>
                        <p class="mb-0"><b>Limit</b></p>
                        <p>@if($pos->limit_day) {{$pos->limit_day}} Hari @else {{$pos->limit_speed}} M/Menit @endif</p>
                        <p class="mb-0"><b>Close Time</b></p>
                        <p>{{ $pos->close_time->format('H:i') }}</p>
                        <p class="mb-0"><b>Re Start Time</b></p>
                        <p>{{ $pos->restart_time->format('H:i') }}</p>

                        <form action="{{ route('user.store-clock', $pos->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <select name="burung_id" class="form-control select2" required id="clock">
                                    <option selected disabled>--Pilih Burung Clock--</option>
                                    @foreach ($burungClock as $item)
                                        <option value="{{ $item->id }}">{{ Helper::noRing($item->club->nama_club, $item->tahun, $item->no_ring) }}-{{ $item->warna }}-{{ $item->jenkel }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group" id="no_stiker" hidden>
                                <label for="no_stiker">No Stiker</label>
                                <input type="text" name="no_stiker" class="form-control" required>
                            </div>
                            <input type="hidden" name="flying_time" id="flying_time">
                            <input type="hidden" name="fly" id="fly">
                            <button class="btn btn-success btn-icon float-right mt-2 mb-3" id="btn-clock" hidden>Input Angka</button>
                        </form>
                        @else
                        <div class="alert alert-danger alert-dismissible">
                            Clock belum dibuka
                        </div>
                        @endif
                    @else
                        <div class="alert alert-success alert-dismissible">
                            Race telah selesai.
                        </div>
                    @endif
                </div>
            </div>
            
            {{-- BASKETING --}}
            <div class="card">
                <div class="card-header">
                    <a data-collapse="#basketing" class="btn btn-icon btn-secondary mr-3" href="#"><i class="fas fa-plus"></i></a>
                    <h4>Basketing</h4>
                </div>
                <div class="collapse" id="basketing">
                    <div class="card-body">
                        @if ($user->burung->count() === 0)
                            <div class="alert alert-danger alert-dismissible">
                                Silahkan tambah data Burung untuk mendaftarkan burung ke Basketing.
                            </div>
                        @else
                            @if ($now->lessThan($pos->tgl_lepasan))
                            <form action="{{ route('user.store-basketing', $pos->id) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Tambah Burung Basketing</label>
                                    <select name="burung_id" class="form-control select2" id="burung" required>
                                        <option selected disabled>--Pilih Burung--</option>
                                        @foreach ($user->burung as $item)
                                        <option value="{{ $item->id }}">{{ Helper::noRing($item->club->nama_club, $item->tahun, $item->no_ring) }}-{{ $item->warna }}-{{ $item->jenkel }}</option>
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
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-icon float-right mb-4" id="btn" hidden>Tambah Burung</button>
                                </div>
                            </form>
                            @endif
                            
                            <br><br>
                            <hr>

                            <span class="mb-2"><b>Total Burung Basketing : </b>{{ $burungBasketing->count() }}</span>

                            @foreach ($burungBasketing as $burung)
                            <ul class="list-group">
                                <li class="list-group-item">
                                    {{ Helper::noRing($burung->club->nama_club, $burung->tahun, $burung->no_ring) }}-{{ $burung->warna }}-{{ $burung->jenkel }} @if($burung->titipan) / {{$burung->titipan}} @endif
                                    @foreach ($burung->basketingKelas as $item)
                                    <span class="badge badge-info">{{$item->nama_kelas}}</span>
                                    @endforeach
                                    <form action="{{ route('user.hapus-basketing', ['race_pos_id' => $pos->id, 'burung_id' => $burung->id]) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" >HAPUS</button>
                                    </form>
                                </li>
                            </ul>
                            @endforeach

                        @endif
                    </div>
                </div>
            </div>

            {{-- ESTIMASI --}}
            <div class="card">
                <div class="card-header">
                    <a data-collapse="#estimasi" class="btn btn-icon btn-secondary mr-3" href="#"><i class="fas fa-plus"></i></a>
                    <h4>Estimasi Kedatangan</h4>
                </div>
                <div class="collapse" id="estimasi">
                    <div class="card-body">
                        <p class="mb-0"><b>Jarak Pos ke Kandang : </b></p>
                        <p>{{ $jarak }} KM</p>
                        <p class="mb-0"><b>Waktu Lepasan : </b></p>
                        <p>{{ $pos->tgl_lepasan->locale('id')->isoFormat('LLLL') }} KM</p>
                        <hr>
                        <p class="mb-0"><b>1300 M/M :</b></p>
                        <p>{{ Helper::estimateArrival($jarak, 1300, $pos->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>1200 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 1200, $pos->tgl_lepasan) }}</p>
                        <p class="mb-0"><b> 1100 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 1100, $pos->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>1000 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 1000, $pos->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>900 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 900, $pos->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>800 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 800, $pos->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>700 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 700, $pos->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>600 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 600, $pos->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>500 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 500, $pos->tgl_lepasan) }}</p>
                    </div>
                </div>
            </div>

            {{-- MAP --}}
            <div class="card">
                <div class="card-header">
                    <a data-collapse="#map" class="btn btn-icon btn-secondary mr-3" href="#"><i class="fas fa-plus"></i></a>
                    <h4>Detail Pos</h4>
                </div>
                <div class="collapse show" id="map">
                    <div class="card-body">
                        <p class="mb-0"><b>Tanggal Inkorv</b> :</p>
                        <p>{{ $pos->tgl_inkorv->locale('id')->isoFormat('LLLL') }}</p>
                        <p class="mb-0"><b>Tanggal dan Jam Lepasan</b> :</p>
                        <p>{{ $pos->tgl_lepasan->locale('id')->isoFormat('LLLL') }}</p>
                        <p class="mb-0"><b>Limit</b></p>
                        <p>@if($pos->limit_day) {{$pos->limit_day}} Hari @else {{$pos->limit_speed}} M/Menit @endif</p>
                        <p class="mb-0"><b>Koordinat :</b></p>
                        <p>{{ $pos->latitude }}, {{ $pos->longitude }}</p>
                        <p class="mb-0"><b>Jarak Pos ke Kandang</b> :</p>
                        <p>{{ Helper::calculateDistance($user->latitude, $user->longitude, $pos->latitude, $pos->longitude) }} KM</p>
                        @include('components.maps')
                        @push('js_script')
                        <script>
                            var userLoc = @JSON($userLoc);
                            var posLoc  = @JSON($posLoc);
                            var points  = [userLoc, posLoc];

                            var mymap = L.map('mapid').setView([userLoc[0], userLoc[1]], 7);
                            L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                maxZoom: 20,
                                subdomains:['mt0','mt1','mt2','mt3']
                            }).addTo(mymap);

                            var firstpolyline = new L.Polyline(points, {
                                color: 'red',
                                weight: 4,
                                opacity: 0.5,
                                smoothFactor: 1
                            });
                            firstpolyline.addTo(mymap);

                            var start = L.marker(userLoc).addTo(mymap).bindPopup("<b>Koordinat Anda</b><br>", {closeOnClick: false, autoClose: false});
                            var end = L.marker(posLoc).addTo(mymap).bindPopup("<b> POS {{ $pos->no_pos }} - {{ $pos->city }} </b><br>", {closeOnClick: false, autoClose: false});

                        </script>
                        @endpush
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
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
        function goBack() {
          window.history.back();
        }
    </script>
    @if ($now->greaterThanOrEqualTo($pos->tgl_lepasan))
    <script>
        $(document).ready(function() {
            $('#city').select2();
            $('#clock').change(function() {
                $('#btn-clock').prop('hidden', false);
                $('#no_stiker').prop('hidden', false);
            });
        });

        var span = document.getElementById('span');

        clock = setInterval (function () {
            var now = new Date();
            var tgl_lepasan = new Date('{{$pos->tgl_lepasan}}');
            var close_time = new Date('{{$pos->close_time}}');
            var restart_time = new Date('{{$pos->restart_time}}');

            var distance = now - tgl_lepasan;
            var off_time = close_time - restart_time;

            var jamSekarang   = now.toTimeString().split(' ')[0];

            if (jamSekarang <= '{{$pos->close_time->format('H:i:s')}}' && jamSekarang >= '{{$pos->restart_time->format('H:i:s')}}') {
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                if (days === 0) {
                    var sisa = distance % (1000 * 60 * 60 * 24); // SISA BAGI DENGAN HARI
                    var openClock = toTime(sisa);
                } else {
                    var clockDays = off_time * days;
                    var sisa = distance % (1000 * 60 * 60 * 24); // SISA BAGI DENGAN HARI
                    var openClock = toTime(sisa + clockDays);
                }

                var fly = openClock[0] + " hours " + openClock[1] + " minutes " + openClock[2] + ' seconds';
                var flying_time = openClock[0] + ":" + openClock[1] + ":" + openClock[2];
                $('#fly').val(fly);
                $('#flying_time').val(flying_time);
                span.textContent = flying_time;
            }  else {
                clearInterval(clock);
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));

                if (days === 0) {
                    var openClock = toTime(off_time);
                } else {
                    var oneday = off_time*2;
                    var cekdays = distance % oneday;
                    var sisadays = Math.floor(cekdays / (1000 * 60 * 60 * 24));
                    if (sisadays === 0){
                        var sisa = off_time;
                    }
                    var clockDays = off_time * days;
                    var openClock = toTime(sisa + clockDays);
                }

                var fly = openClock[0] + " hours " + openClock[1] + " minutes " + openClock[2] + ' seconds';
                var flying_time = openClock[0] + ":" + openClock[1] + ":" + openClock[2];
                $('#fly').val(fly);
                $('#flying_time').val(flying_time);
                span.textContent = "CLOSE TIME";
            }
        }, 1000);

        function toTime (time) {
            var hours = Math.floor((time / (1000 * 60 * 60)));
            var minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((time % (1000 * 60)) / 1000);

            return [hours, minutes ,seconds];
        }
    </script>
    @endif
@endpush

@endsection