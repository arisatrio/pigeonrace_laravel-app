@extends('layouts.app')
@section('title', 'Cek Map')
@section('content')
<div class="section-header">
    <h1>CEK MAP</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">CEK MAP</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-pills mb-3">
                        <li class="nav-item">
                        <a onclick="goBack()" class="nav-link text-white btn-secondary btn-sm btn-icon mr-2" href="#">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        </li>
                    </ul>
                    @include('components.maps')
                    @push('js_script')
                        <script>
                            var latlong = @JSON([$userLoc[0], $userLoc[1]]);
                            var koordinat = @JSON([$user->latitude, $user->longitude]);
                            var mymap = L.map('mapid').setView(latlong, 15);
                            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                maxZoom: 20,
                                subdomains:['mt0','mt1','mt2','mt3']
                            }).addTo(mymap);

                            var marker = L.marker([latlong[0], latlong[1]]).addTo(mymap);
                            marker.bindPopup("<b>{{$user->name}} </b><br>"+koordinat).openPopup();

                            function goBack() {
                            window.history.back();
                            }
                        </script>
                    @endpush
                </div>
            </div>
                
            

        </div>
    </div>
</div>
@endsection