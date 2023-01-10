@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Target Actor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">All Verified Reports in Iligan</li>
    </ol>
    
<div class="container">
    <div class="readersack">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ">
                    <h3>Google Map</h3>
                    <div id="map" style="height:800px; border: 5px solid black;"></div>
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