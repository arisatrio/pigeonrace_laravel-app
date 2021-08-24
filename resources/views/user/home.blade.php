@extends('layouts.app')
@section('title', 'Home')
@section('content')

@if ($isUserJoin === false)
    <div class="section-header">
        <h1>Home</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item">Home</div>
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
                @if (auth()->user()->latitude == null)
                <div class="alert alert-danger alert-dismissible">
                    Anda belum setting Koordinat. Setting Koordinat untuk melihat dan mengikuti lomba.
                </div>
                @endif
                <div class="alert alert-danger alert-dismissible">
                    Tidak ada Race di ikuti.
                </div>
            </div>
        </div>
        <hr>
        <h2 class="section-title">
            Jadwal Race
        </h2>
        @if (auth()->user()->latitude != null)
            @foreach ($race as $item)
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image" data-background="{{ asset('assets/img/poster/'.$item->poster) }}"></div>
                            <div class="article-title">
                                <h2><a href="#">{{ $item->nama_race }}</a></h2>
                            </div>
                        </div>
                        <div class="article-details">
                            <small><b> {{ $item->tgl_race->diffForHumans() }} </b></small>
                            <p>{{ $item->deskripsi }}</p>
                            <div class="article-cta">
                                <a href="{{ route('user.race.show', $item->id) }}" class="btn btn-lg btn-primary">Lihat Detail Lomba</a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            @endforeach
        @endif
    </div>
@else
<div class="section-header">
    <h1>{{ $r->nama_race }}</h1>
</div>
<div class="section-body">
    <div class="row">
        <div class="col">
            @if (session('messages'))
            <div class="alert alert-success alert-dismissible">
                {{ session('messages') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="dropdown mb-4">
                        <button class="btn btn-warning">POS {{ $posActive->no_pos }} - {{ $posActive->city }}</button>
                    </div>
                </div>
            </div>

            
            {{-- <div class="card text-center">
                <div class="card-header">
                    <h4>Waktu Lepasan / flying time ketika mulai lepasan</h4>
                </div>
                <div class="card-body">
                    <div class="row" id="clockdiv">
                        <div class="col-3">
                            <div class="bg-primary">
                                <span class="days bg-primary"></span>
                                <div class="smalltext">Hari</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="bg-primary">
                                <span class="hours bg-primary"></span>
                                <div class="smalltext">Jam</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="bg-primary">
                                <span class="minutes bg-primary"></span>
                                <div class="smalltext">Menit</div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="bg-primary">
                                <span class="seconds bg-primary"></span>
                                <div class="smalltext">Detik</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            @if ($now->greaterThanOrEqualTo($posActive->tgl_lepasan))
            <div class="card">
                <div class="card-header">
                    <h4>Clock</h4>
                </div>
                <div class="card-body">
                    <p class="mb-0 text-center">Waktu Terbang</p>
                    <h2 id="span" class="text-center mb-4"></h2>
                    <p class="mb-0"><b>Tanggal dan Jam Lepasan</b> :</p>
                    <p>{{ $posActive->tgl_lepasan->isoFormat('LLLL') }}</p>
                    <p><b>Close Time</b></p>
                    <p><b>Re Start Time</b></p>
                    <form action="{{ route('user.store-clock', $posActive->id) }}" method="POST">
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
                        <button class="btn btn-success btn-icon float-right mt-2 mb-3" id="btn-clock" hidden>Input Angka</button>
                    </form>
                </div>
            </div>
            @else
            <div class="alert alert-danger alert-dismissible">
                Clock belum dibuka
            </div>
            @endif
            
            <div class="card">
                <div class="card-header">
                    <a data-collapse="#pos" class="btn btn-icon btn-secondary mr-3" href="#"><i class="fas fa-plus"></i></a>
                    <h4>Detail Pos</h4>
                </div>
                <div class="collapse show" id="pos" style="">
                    <div class="card-body">
                        <p class="mb-0"><b>Tanggal Inkorv</b> :</p>
                        <p>{{ $posActive->tgl_inkorv->isoFormat('LLLL') }}</p>
                        <p class="mb-0"><b>Tanggal Lepasan</b> :</p>
                        <p>{{ $posActive->tgl_lepasan->isoFormat('LLLL') }}</p>
                        <p class="mb-0"><b>Koordinat :</b></p>
                        <p>{{ $posActive->latitude }}, {{ $posActive->longitude }}</p>
                        <p class="mb-0"><b>Jarak Pos ke Kandang</b> :</p>
                        <p>{{ $jarak }} KM</p>
                        @include('components.maps')
                    </div>
                </div>
            </div>
                
            <div class="card">
                <div class="card-header">
                    <a data-collapse="#basketing" class="btn btn-icon btn-secondary mr-3" href="#"><i class="fas fa-plus"></i></a>
                    <h4>Basketing</h4>
                </div>
                <div class="collapse" id="basketing">
                    <div class="card-body">
                        <p><b>Total Burung :</b>{{ $basketing->count() }}</p>
                        @foreach ($basketing as $item)
                        <div class="accordion">
                            <div class="accordion-header">
                                <h4>{{ Helper::birdName($item, auth()->user()->name) }}</h4>
                            </div>
                        </div>
                        @endforeach
                        <a href="{{ route('user.add-basketing', ['id' => $r->id, 'race_pos_id' => $posActive->id]) }}" class="btn btn-success float-right mt-3 mb-3"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>

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
                        <p>{{ $posActive->tgl_lepasan->locale('id')->isoFormat('LLLL') }} KM</p>
                        <hr>
                        <p class="mb-0"><b>1300 M/M :</b></p>
                        <p>{{ Helper::estimateArrival($jarak, 1300, $posActive->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>1200 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 1200, $posActive->tgl_lepasan) }}</p>
                        <p class="mb-0"><b> 1100 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 1100, $posActive->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>1000 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 1000, $posActive->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>900 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 900, $posActive->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>800 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 800, $posActive->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>700 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 700, $posActive->tgl_lepasan) }}</p>
                        <p class="mb-0"><b>600 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 600, $posActive->tgl_lepasan) }}</p>
                        <p><b>500 M/M : </b></p>
                        <p>{{ Helper::estimateArrival($jarak, 500, $posActive->tgl_lepasan) }}</p>
                    </div>
                </div>
            </div>   
            
            <div class="card">
                <div class="card-header">
                    <a data-collapse="#mycard-collapse" class="btn btn-icon btn-secondary mr-3" href="#"><i class="fas fa-plus"></i></a>
                    <h4>Hasil</h4>
                </div>
                <div class="collapse" id="mycard-collapse" style="">
                    <div class="card-body">
                        @if ($now->greaterThanOrEqualTo($posActive->tgl_lepasan))
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
                                    <p>{{ $item->clock->arrival_date }} {{ $item->clock->arrival_clock}}</p>
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

            @if($basketing->isEmpty())
            <form action="{{ route('user.stop-join', $r->id) }}" method="POST">
                @csrf
                <button class="btn btn-block btn-danger">Berhenti Ikuti Race</button>
            </form>
            @endif

        </div>
    </div>
</div>

@push('css_script')
    <style>
        #clockdiv{
            font-family: sans-serif;
            color: #fff;
            font-weight: 100;
            text-align: center;
            font-size: 30px;
        }
        #clockdiv > div{
            padding: 10px;
            border-radius: 3px;
            background: #e2e2e2;
        }
        #clockdiv div > span{
            border-radius: 3px;
        }
        .smalltext{
            padding-top: 5px;
            font-size: 16px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js_script')
    <script>
        var userLoc = @JSON([auth()->user()->latitude, auth()->user()->longitude]);
        var posLoc  = @JSON([$posActive->latitude, $posActive->longitude]);
        var points  = [userLoc, posLoc];

        var mymap = L.map('mapid').setView(userLoc, 6);
        L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
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

        var start = L.marker(userLoc).addTo(mymap).bindPopup("<b>Koordinat Anda : </b><br>."+userLoc+".", {closeOnClick: false, autoClose: false});
        var end = L.marker(posLoc).addTo(mymap).bindPopup("<b> POS {{ $posActive->no_pos }} - {{ $posActive->city }} : </b><br>."+posLoc+".", {closeOnClick: false, autoClose: false});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#city').select2();
            $('#clock').change(function() {
                $('#btn-clock').prop('hidden', false);
                $('#no_stiker').prop('hidden', false);
                console.log('cek');
            });
        });

        var span = document.getElementById('span');
        
        setInterval(function () {
            // Get todays date and time
            var now = new Date();
            var countDownDate = new Date('{{$posActive->tgl_lepasan}}');

            // Find the distance between now an the count down date
            var distance = now - countDownDate;

            // Time calculations for days, hours, minutes and seconds
            //var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance / (1000 * 60 * 60)));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            span.textContent = hours + ":" + minutes + ":" + seconds;
        }, 1000);
    </script>
    <script>
        
    </script>
@endpush

@endif

@endsection