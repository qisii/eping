@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<style>
    #map {
        /* width: 80%; */
        border-radius: 10px;
        height: 500px;
        box-shadow: rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px, rgba(17, 17, 26, 0.1) 0px 24px 80px;
    }
    table {
        /* border: 1px solid black */
        box-shadow: rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px, rgba(17, 17, 26, 0.1) 0px 24px 80px;

    }
    .container-fluid {
        margin-bottom: 1em;
    }
    th {
        width: 10%;
        font-size: 12px
    }
    td {
        padding: 5px;
    }
    @media (max-width:550px) {
        p {
            font-size: 10px
        }

    }
</style>
<a class="btn btn-secondary my-3 mx-2" href="{{ url('target_actor/viewreport') }}"><i class="fa-solid fa-arrow-left-long"></i> Back </a>
<div class="container-fluid px-4">
    {{-- <div class="card-body">
        @if (session('message'))
            <div class="alert alert-success">{{  session('message')  }}</div>
        @endif
    </div> --}}
    {{-- <button onclick="location.href='/target_actor/viewreport'">Back </button> --}}
    <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">Emergency Type</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Report Log</th>
                    <th scope="col">Date created</th>
                    {{-- <th scope="col">Date</th> --}}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>{{ $posts->incident_type}}</p>
                        </td>
                        <td>
                            @if( $posts->description != null)
                                <p>{{ $posts->description }}</p>
                            @else
                                <strong><p>NO DESCRIPTION GIVEN BY THE USER</p></strong>
                            @endif
                            <img src="{{  url('storage/app/' . $posts->image_path)  }}" />
                        </td>
                        <td>
                            @if($posts->response_status==1)
                                <p>A response Team is on your Way.
                                    Please wait in a safe area.
                                </p>
                            @elseif($posts->response_status==2)
                                <p>The response Team is on the scene.</p>
                            @else
                                <p>Your report is to be seen</p>
                            @endif
                        @if($posts->updated_at != $posts->created_at && $posts->response_status == 1)
                        <td>
                            
                            <p>This report was seen at {{$posts->updated_at}} </p>
                            

                        </td>
                        @elseif($posts->updated_at != $posts->created_at && $posts->response_status == 2)
                        <td>
                            
                            <p>The Response Team Arrived at {{$posts->updated_at}} </p>
                            

                        </td>
                        @endif
                        <td>
                            <p>{{$posts->created_at}} </p>

                        </td>
                    </tr>
                </tbody>
                <script>
                    window.addEventListener("load", function() {
                        if(typeof window.showMap === "function"){
                            window.showMap({{ $posts->latitude }}, {{ $posts->longitude }});
                        }
                    });
                </script>
            </table>
        </form>
    </div>
</div>

<div class="container mb-5 align-items-center">
    <div id="map" style="height: 300px;"></div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCpITCZus5GDSeqAO0guUi7Mc80BWGSpV4&libraries=places"></script>

<script>
    $(document).ready(function(){
        var autocomplete;
        var to = 'location';
        autocomplete = new google.maps.places.Autocomplete((document.getElementById(to)),{
            types:['geocode'],
        });
    
    });

    // map
    function showMap(lat,long)
    {
        var coord = { lat:lat, lng:long };
    
        var map = new google.maps.Map(
            document.getElementById("map"),
            {
                zoom: 15,
                center: coord,
                styles: [
                    {
                        "featureType": "poi",
                        "stylers": [
                            { "visibility": "off"}
                        ]
                    }
                ]
            });
            
        var marker = new google.maps.Marker({
        position:coord,
        animation: google.maps.Animation.BOUNCE,
        map:map
        });
    }
    showMap(0,0);
</script>
@endsection