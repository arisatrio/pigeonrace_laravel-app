@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="section-header">
    <h1>Dashboard</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item">Dashboard</div>
    </div>
</div>
@isset($race)
<div class="section-body">
    <div class="row">
        <div class="col-12">

            <div class="row mb-2">
                <div class="col-6">
                    <h2 class="section-title">
                        {{ $race->nama_race }}
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <ul class="nav nav-pills mb-3">
                        {{-- @foreach ($race->pos as $item)
                        <li class="nav-item">
                            <a href="" class=" nav-link text-white btn 
                                @isset($pos->id)
                                    @if($item->id === $pos->id) btn-success @endif
                                @endisset btn-secondary btn-md mr-2">
                                <i class="fas fa-map-marker-alt"></i>
                                POS {{ $item->no_pos }}
                            </a>
                        </li> 
                        @endforeach --}}
                        <li class="nav-item">
                            <a class="nav-link text-white btn-danger btn-sm mr-2" href="#">
                              TOTAL POS
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Maps</h4>
                </div>
                <div class="card-body">
                    @include('components.maps')
                    @push('js_script')
                        <script>
                            var latlong = @JSON($latlong);
                            var mymap = L.map('mapid').setView([-7.33194,110.49278], 7);
                            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                                maxZoom: 20,
                                subdomains:['mt0','mt1','mt2','mt3']
                            }).addTo(mymap);
    
                            for (var i = 0; i < latlong.length; i++) {
                                marker = new L.marker([latlong[i][1], latlong[i][2]])
                                .bindPopup("<b>Nama Peserta : </b> <br>" + latlong[i][0])
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
                                    <h1>{{ $race->join->count() }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h5>Burung</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1>
                                      
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h5>Clock</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1>
                                        
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    {{-- <div class="row">
            
                        <div class="col-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h4>Top Peserta</h4>
                                    <div class="card-header-action">
                                        <a href="#" class="btn btn-primary">
                                        View All
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
            
                        <div class="col-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h4>Top Burung</h4>
                                    <div class="card-header-action">
                                        <a href="#" class="btn btn-primary">
                                        View All
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
            
                    </div>
            
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Hasil</h4>
                </div>
                <div class="card-body">        
                    <div class="row">
                        <div class="col">
                            
                        </div>
                    </div>
                </div>
            </div> --}}



        </div>
        {{-- <div class="col-12">

            
            
            
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
                                    <h1>{{ $race->join->count() }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h5>Burung</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1>
                                    @foreach ($race->pos as $item)
                                        {{ $item->basketing->count() }} 
                                    @endforeach    
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h5>Clock</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1>
                                        @foreach ($race->pos as $item)
                                            {{ $item->clock->count() }}
                                        @endforeach
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
            
                        <div class="col-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h4>Top Peserta</h4>
                                    <div class="card-header-action">
                                        <a href="#" class="btn btn-primary">
                                        View All
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
            
                        <div class="col-6">
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h4>Top Burung</h4>
                                    <div class="card-header-action">
                                        <a href="#" class="btn btn-primary">
                                        View All
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
            
                    </div>
            
                </div>
            </div>
            
            
            <div class="card">
                <div class="card-header">
                    <h4>Hasil</h4>
                </div>
                <div class="card-body">        
                    <div class="row">
                        <div class="col">
                            
                        </div>
                    </div>
                </div>
            </div>
            
            </div>
    </div> --}}
</div>
@endisset
@endsection
