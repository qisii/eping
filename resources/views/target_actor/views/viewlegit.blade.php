@extends('layouts.targetactor-master')
@section('title', 'Reports Visualization')
@section('content')

<style>
    #map {
        /* width: 80%; */
        border-radius: 10px;
        height: 500px;
        box-shadow: rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px, rgba(17, 17, 26, 0.1) 0px 24px 80px;
    }
</style>
<div class="container-fluid d-flex justify-content-center align-items-center ">
    {{-- <h1 class="mt-4">Target Actor</h1> --}}
    <div class="container ">
        <div class="readersack">
            <div class="container">
                <div class="row">
                    <div class="container-fluid col-md-12">
                        <h4 class="my-4">Compiled Legitimate Eping Reports</h4>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
</div>

<script type="text/javascript">
    function initializeMap() {
        const markers = [];
        const locations = <?php echo json_encode($posts) ?>;
        const map = new google.maps.Map(document.getElementById("map"),
            {
                styles: [{
                            "featureType": "poi",
                            "stylers": [{ "visibility": "off" }]
                        }]
            });
        var infowindow = new google.maps.InfoWindow();
        var bounds = new google.maps.LatLngBounds();
        for (var location of locations) {
            let marker = new google.maps.Marker({
                position: new google.maps.LatLng(location.latitude, location.longitude),
                animation: google.maps.Animation.DROP,
                map: map
            });
            markers.push(marker);
            bounds.extend(marker.position);
            google.maps.event.addListener(marker, 'click', (function(marker, location) {
                return function() {
                    infowindow.setContent("Incident Type: " + location.incident_type  + "<br>" + "Description: " + location.description);
                    infowindow.open(map, marker);
                }
            })(marker, location));
            new markerClusterer.MarkerClusterer({
            map,
            markers
        });
        }map.fitBounds(bounds);
    }
</script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyCpITCZus5GDSeqAO0guUi7Mc80BWGSpV4&callback=initializeMap"></script>


@endsection