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
                    <a onclick="goBack()" class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="#home3">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white btn-primary btn-sm btn-icon mr-2" href="#home3">
                      <i class="fas fa-home"></i> 
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

            @if ($error->any())
            <div class="alert alert-danger alert-dismissible">
                @foreach ($errors->all() as $error)
                    {{$error}} <br>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Clock</h4>
                </div>
                <div class="card-body">
                    @if ($now->greaterThanOrEqualTo($pos->tgl_lepasan))
                    <p class="mb-0 text-center">Waktu Terbang</p>
                    <h2 id="span" class="text-center mb-4"></h2>
                    <p class="mb-0"><b>Tanggal dan Jam Lepasan</b> :</p>
                    <p>{{ $pos->tgl_lepasan->isoFormat('LLLL') }}</p>
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
                                <option value="{{ $item->id }}">{{ Helper::birdName($item, auth()->user()->name) }}</option>
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
                        @if ($now->lessThan($pos->tgl_lepasan))
                        <form action="{{ route('user.store-basketing', $pos->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Tambah Burung Basketing</label>
                                <select name="burung_id" class="form-control select2" id="burung" required>
                                    <option selected disabled>--Pilih Burung--</option>
                                    @foreach ($user->burung as $item)
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
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-icon float-right mb-4" id="btn" hidden>Tambah Burung</button>
                            </div>
                        </form>
                        @endif
                        
                        <br><br>
                        <hr>

                        <span><b>Total Burung : </b>{{ $basketing->count() }}</span>
                        @foreach ($pos->race->kelas as $item)
                        
                        <div id="accordion">
                            <div class="accordion mt-4">
                                <div class="accordion-header bg-primary text-white" role="button" data-toggle="collapse" data-target="#panel-body-{{$item->id}}">
                                    <b>{{ $item->nama_kelas }}</b>
                                </div>
                                <div class="accordion-body show" id="panel-body-{{$item->id}}" data-parent="#accordion">
                                    @foreach ($user->burung as $item)
                                    {{ $item->basketingKelas }}
                                    <div id="accordion">
                                        <div class="accordion">
                                            <div class="accordion-header">
                                                {{-- <b class="form-check-label">{{ Helper::birdName($burung, auth()->user()->name) }}</b>     --}}
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>                 
                        
                        @endforeach
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

            {{-- HASIL --}}
            <div class="card">
                <div class="card-header">
                    <a data-collapse="#mycard-collapse" class="btn btn-icon btn-secondary mr-3" href="#"><i class="fas fa-plus"></i></a>
                    <h4>Hasil</h4>
                </div>
                <div class="collapse" id="mycard-collapse" style="">
                    <div class="card-body">
                        @if ($now->greaterThanOrEqualTo($pos->tgl_lepasan))
                        <p><b>Total Burung Clock : </b> {{ $hasilClock->count() }}</p>
                        @foreach ($hasilClock as $burung)
                        <div id="accordion">
                            <div class="accordion">
                                <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-{{$burung->id}}">
                                    <b>{{ Helper::birdName($burung, auth()->user()->name) }}</b>
                                </div>
                                <div class="accordion-body collapse" id="panel-body-{{$burung->id}}" data-parent="#accordion">
                                    @foreach ($burung->clock as $item)
                                    <p class="mb-0"><b>Tanggal dan Jam Kedatangan : </b></p>
                                    <p>{{ $item->clock->arrival_clock->locale('id')->isoFormat('LLLL') }}</p>
                                    <p class="mb-0"><b>H+ : </b></p>
                                    <p>{{ $item->clock->arrival_day }}</p>
                                    <p class="mb-0"><b>Waktu Terbang : </b></p>
                                    <p>{{ $item->clock->flying_time }}</p>
                                    <p class="mb-0"><b>Kecepatan : </b></p>
                                    <p>{{ $item->clock->velocity }}</p>                             
                                    @endforeach
                                </div>
                            </div>
                        </div>                 
                        @endforeach
                        @else
                        <div class="alert alert-danger alert-dismissible">
                            Clock belum dibuka
                        </div>
                        @endif
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
            var off_time =  close_time - restart_time;

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