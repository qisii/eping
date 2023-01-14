@extends('layouts.keyactor-master')
@section('title', 'View Reports')
@section('content')

<style>
    #map {
        /* width: 80%; */
        border-radius: 10px;
        height: 500px;
        box-shadow: rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px, rgba(17, 17, 26, 0.1) 0px 24px 80px;
    }



</style>
<a class="btn btn-secondary m-4" href="{{ url('key_actor/report/viewreport') }}"><i class="fa-solid fa-arrow-left-long"></i> Back </a>
<div class="container p-4 d-grid grid-items-center">
    <div class="container mb-3">
        <div id="map" style="height: 300px;"></div>
    </div>
    <form action="/key_actor/report/updatereport/{{$posts->id}}" method="post" enctype="multipart/form-data">
        @csrf 
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <div>{{$error}}</div> 
                @endforeach
            </div>
        @endif
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{  session('message')  }}</div>
            @endif
        </div>
        @method("put")
        {{--  This for the Description --}}
        <div class="row mb-3">
            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

            <div class="col-md-6">
                {{-- <textarea  cols="10" rows="5" id="description" type="text"  name="description"  placeholder="{{$posts->description}}" class="form-control" autofocus></textarea> --}}
                <div>       
                    @if( $posts->description != null)
                        <p>{{ $posts->description }}</p>
                    @else
                        <strong><p>NO DESCRIPTION GIVEN BY THE USER</p></strong>
                    @endif
                </div>
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        {{--  This for the Response --}}
        <div class="row mb-3">
            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Response Status') }}</label>

            <div class="col-md-6">
                
                <select id="response_status" type="text"  name="response_status"  class="form-control" autofocus>
                    <option value={{$posts->response_status}}>
                        @if($posts->response_status==1)
                            Responding
                        @elseif($posts->response_status==2)
                            On the Scene
                        @elseif($posts->response_status==3)
                            Case Closed
                        @elseif($posts->response_status==0)
                            Pending
                        @endif
                    </option>
                    @if($posts->response_status==0)
                        <option value="1">Responding</option>
                        <option value="2">On the Scene</option>
                        <option value="3">Case Closed</option>
                    @elseif($posts->response_status==1)
                        <option value="2">On the Scene</option>   
                        <option value="3">Case Closed</option>
                    @elseif($posts->response_status==2)
                        <option value="1">Responding</option>   
                        <option value="3">Case Closed</option>
                    @elseif($posts->response_status==3)
                        <option value="1">Responding</option>   
                        <option value="2">On the Scene</option>
                    @endif
                </select>
                @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>



        <div class="row mb-3">
            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Legitimacy') }}</label>

            <div class="col-md-6">
                
                <select id="legitimacy" type="text"  name="legitimacy"  class="form-control" autofocus>
                    <option value={{$posts->legitimacy}}>
                        @if($posts->legitimacy== 0)
                            To be set
                        @elseif($posts->legitimacy==1)
                            True
                        @elseif($posts->legitimacy==2)
                            False
                        @endif
                    </option>
                    @if($posts->legitimacy== 0)
                    <option value="1">True</option>
                    <option value="2">False</option> 
                    @elseif($posts->legitimacy==1)
                    <option value="2">False</option>
                    @elseif($posts->legitimacy==2)
                    <option value="1">True</option>


                    
                    @endif
                </select>
                @error('type')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Submit') }}
                </button>
            </div>
        </div>
    </form>

    </div>
</div>

<script>
    window.addEventListener("load", function() {
        if(typeof window.showMap === "function"){
            window.showMap({{ $posts->latitude }}, {{ $posts->longitude }});
        }
    });
</script>

{{-- <div class="container mb-5">
    <div id="map" style="width: 100%; height: 300px;"></div>
</div> --}}

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