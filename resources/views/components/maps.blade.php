<div id="mapid" class="mb-4" style="min-height: 400px;"></div>
@push('css_script')
    @include('layouts.leaflet-assets')
@endpush
{{-- @push('js_script')
@isset($user)
    <script>
        var lat = @JSON($user->latitude);
        var long = @JSON($user->longitude);
        var latLong = [lat, long];
        if (lat == null) {
            latLong = @JSON($liveLoc);
        };
    </script>
@endisset
<script>
    var latLong = [-7.25792351, 112.79242516];
    var latLong2 = @JSON([$posActive->latitude, $posActive->longitude]);
    var point = [latLong, latLong2];
    console.log(point);
    
    var mymap = L.map('mapid').setView(latLong, 15);
    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(mymap);

    var firstpolyline = new L.Polyline(point, {
        color: 'red',
        weight: 3,
        opacity: 0.5,
        smoothFactor: 1
    });
    firstpolyline.addTo(mymap);

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
@endpush --}}