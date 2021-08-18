@extends('layouts.app-user')

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
                                <div class="form-group">
                                    <label for="city">Pilih Kota</label>
                                    <select name="city" class="form-control">
                                        <option selected disabled>--Pilih Kota--</option>
                                        @foreach ($city as $item)
                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="latitude" class="control-label">Latitude</label>
                                    <input id="latitude" type="text" class="form-control" name="latitude" value="{{ $user->latitude }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="longitude" class="control-label">Longitude</label>
                                    <input id="longitude" type="text" class="form-control" name="longitude" value="{{ $user->longitude }}" required>
                                </div>
                            </div>
                        </div>
                        <div id="mapid" style="min-height: 400px;"></div>
                        <script>
                            var lat = @JSON($user->latitude);
                            var long = @JSON($user->longitude);
                            var latLong = [lat, long];
                            if (lat == null) {
                                latLong = @JSON($liveLoc);
                            };
                            
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
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <button type="submit" class="float-right btn btn-primary mt-4">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection