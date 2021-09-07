@extends('layouts.app')
@section('title', 'Hasil Race')
@section('content')
<div class="section-header">
    <h1>CEK MAP</h1>
</div>
<div class="section-body">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
              <div class="card-body">
                @include('components.maps')
              </div>
            </div>
        </div>

    </div>
</div>
@push('js_script')
    <script>
        var latlong = @JSON([$user->latitude, $user->longitude]);
        var mymap = L.map('mapid').setView(userLoc, 6);
        L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(mymap);

        var marker = L.marker(latLong).addTo(mymap);
        marker.bindPopup("<b>Koordinat Anda : </b><br>."+latLong+".").openPopup();

    </script>
@endpush