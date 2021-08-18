@extends('layouts.app-admin')

@section('content')
<div class="section-header">
    <h1>Buat Race</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Buat Race</div>
    </div>
</div>
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Race</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.club.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nama_race">Nama Race</label>
                                    <input type="text" class="form-control" name="nama_race">
                                    @error('nama_race')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="datetime-local" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" rows="5" style="height:100%;"></textarea>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Data Lepasan</h5>
                </div>
                <div class="card-body">
                    <div id="accordion">
                        <div class="accordion">
                            <div class="accordion-header bg-danger" role="button" data-toggle="collapse" data-target="#panel-body-1" aria-expanded="true">
                                <b>Pos 1</b>
                            </div>
                            <div class="accordion-body collapse show" id="panel-body-1" data-parent="#accordion">
                                {{-- input hidden to field no_pos --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_pos">No Pos</label>
                                            <input type="number" class="form-control" name="no_pos">
                                            @error('no_pos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_pos">Nama Pos</label>
                                            <input type="text" class="form-control" name="nama_pos">
                                            @error('nama_pos')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="latitude">Latitude</label>
                                            <input type="text" class="form-control" name="latitude">
                                            @error('latitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="longitude">Longitude</label>
                                            <input type="text" class="form-control" name="longitude">
                                            @error('longitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Release</label>
                                            <input type="datetime-local" class="form-control" name="release">
                                        </div>
                                        <div class="form-group">
                                            <label>Close</label>
                                            <input type="datetime-local" class="form-control" name="close">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="mapid" style="min-height: 400px;"></div>
                                        <script>
                                            var latLong = [-7.250445, 112.768845];
                                            
                                            var mymap = L.map('mapid').setView(latLong, 13);
                                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                            }).addTo(mymap);
                                        
                                            var marker = L.marker(latLong).addTo(mymap);
                                            marker.bindPopup("<b>Koordinat Anda : </b><br>."+latLong+".").openPopup();
                                        
                                            var markerr;
                                            mymap.on('click', function(e) {
                                                let latitude = e.latlng.lat.toString().substring(0, 15);
                                                let longitude = e.latlng.lng.toString().substring(0, 15);
                                                $('#latitude').val(latitude);
                                                $('#longitude').val(longitude);
                                                if (markerr != undefined) {
                                                    mymap.removeLayer(markerr);
                                                };
                                                var popupContent = "<b>Koordinat : </b><br>." + latitude + ", " + longitude + ".";
                                                markerr = L.marker([latitude, longitude]).addTo(mymap);
                                                markerr.bindPopup(popupContent)
                                                .openPopup();
                                            });
                                        </script>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="accordion">
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-2">
                                <b>Pos 2</b>
                            </div>
                            <div class="accordion-body collapse" id="panel-body-2" data-parent="#accordion">
                                CEK
                            </div>
                        </div>
                    </div>
                    <div id="accordion">
                        <div class="accordion">
                            <div class="accordion-header" role="button" data-toggle="collapse" data-target="#panel-body-3">
                                <b>Pos 3</b>
                            </div>
                            <div class="accordion-body collapse" id="panel-body-3" data-parent="#accordion">
                                CEK
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class=" mt-4 float-right btn btn-block btn-primary">Simpan</button>
        </div>
    </div>
</div>
@endsection
