@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')


<div class="container-fluid px-4">
    <h1 class="mt-4">Target Actor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"></li>
    </ol>
    
    <div class="card-body">
        @if (session('message'))
            <div class="alert alert-success">{{  session('message')  }}</div>
        @endif
    </div>
    <button onclick="location.href='/target_actor/viewreport'">Back </button>
    <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Attached Image</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>
                        {{-- <tr onclick="showMap({{ $posts->latitude }}, {{ $posts->    }})"> --}}
                        <tr>
                            <td>
                                <h3>{{ $posts->incident_type}}</h3>
                            </td>

                            <td>
                                @if($posts->description != NULL)
                                <h3>Description</h3>
                                <p>{{  $posts->description  }}</p>
                                @endif
                                <img src="{{  url('storage/app/' . $posts->image_path)  }}" />
                            </td>
                            <td>
                                @if($posts->response_status==1)
                                    <h2>A response Team is on your Way.
                                        Please wait in a safe area.
                                    </h2>
                                @elseif($posts->response_status==2)
                                    <h2>The response Team is on the scene.</h2>
                                @else
                                    <h2>Your report is to be seen</h2>
                                @endif
                            </td>
                            @if($posts->updated_at != $posts->created_at && $posts->response_status == 1)
                            <td>
                                
                                <h2>This report was seen at {{$posts->updated_at}} </h2>
                                

                            </td>
                            @elseif($posts->updated_at != $posts->created_at && $posts->response_status == 2)
                            <td>
                                
                                <h2>The Response Team Arrived at {{$posts->updated_at}} </h2>
                                

                            </td>
                            @endif
                            <td>
                                <h2>This report was created at {{$posts->created_at}} </h2>

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

<div class="container mb-5">
    <div id="map" style="width: 100%; height: 300px;"></div>
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