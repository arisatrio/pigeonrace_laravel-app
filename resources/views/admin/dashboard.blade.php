@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="section-header">
    <h1>Dashboard</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">Dashboard</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="row">
                <div class="col-12">
                    <button class="btn btn-primary btn-block dropdown-toggle text-uppercase" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{$selectedRace->nama_race}}
                    </button>
                    <div class="dropdown-menu" x-placement="bottom-start">
                        @foreach ($allRace as $item)
                            <a class="dropdown-item" href="{{ route('admin.dashboard-select', $item->slug) }}">{{$item->nama_race}}</a>
                        @endforeach
                      </div>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-6">
                    <h2 class="section-title text-uppercase">
                        {{ $selectedRace->nama_race }}
                    </h2>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Maps</h4>
                </div>
                <div class="card-body">
                    @include('components.maps')
                    @push('js_script')
                        <script src="{{ asset('assets/js/L.Polyline.SnakeAnim.js') }}"></script>
                        <script>
                            var posMarker = new L.Icon({
                                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
                                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                                iconSize: [25, 41],
                                iconAnchor: [12, 41],
                                popupAnchor: [1, -34],
                                shadowSize: [41, 41]
                            });
                            var color = ['blue', 'green', 'red', 'yellow', 'orange'];
                            var latlong = @JSON($userLoc);
                            var posLatLong = @JSON($posLoc);
                            console.log(posLatLong);

                            var mymap = L.map('mapid').setView([-7.33194,110.49278], 7);
                            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                maxZoom: 20,
                                subdomains:['mt0','mt1','mt2','mt3']
                            }).addTo(mymap);
    
                            for (var i = 0; i < latlong.length; i++) {
                                marker = new L.marker([latlong[i][1], latlong[i][2]]);
                                
                                for(var j = 0; j <posLatLong.length; j++){
                                    var pos = L.layerGroup([
                                        L.polyline([ [latlong[i][1],latlong[i][2]], [posLatLong[j][1], posLatLong[j][2]] ], {
                                            color: color[j],
                                            weight: 4,
                                            opacity: 0.5,
                                            smoothFactor: 1,
                                            snakingSpeed: 200,
                                        }),
                                    ], { snakingPause: 200 });

                                    pos.addTo(mymap).snakeIn();
                                    var loc = L.latLng([latlong[i][1], latlong[i][2]]);
                                    var pos = L.latLng([posLatLong[j][1], posLatLong[j][2]]);
                                    var distance = "POS " + posLatLong[j][0] + " : " + loc.distanceTo(pos).toFixed(0)/1000 + " KM" + "<br>";
                                    latlong[i].push(distance);
                                }
                                function filtered(array){
                                    var arrayJarak = array;
                                    var filtered = arrayJarak.splice(0,3);
                                    var jarak = arrayJarak.join("");

                                    return jarak;
                                }
                                marker.bindPopup("<b>"+latlong[i][0]+"</b>" + "<br>" + filtered(latlong[i])).addTo(mymap);
                            };
                            for (var i = 0; i < posLatLong.length; i++) {
                                marker = new L.marker([posLatLong[i][1], posLatLong[i][2]], {icon: posMarker})
                                .bindPopup("<b>POS "+ posLatLong[i][3] + " : " + posLatLong[i][0] + "</b>")
                                .addTo(mymap);
                            };
                        </script>
                    @endpush
                    
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Statistik</h4>
                </div>
                <div class="card-body">
            
                    <div class="row mb-4">
                        <div class="col">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h5>Peserta</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1>{{ $selectedRace->join->count() }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h5>Burung</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1>{{ $basketing->count() }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h5>Clock</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1>{{ $selectedRace->clock->count() }}</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
