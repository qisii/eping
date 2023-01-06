@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Target Actor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Submit Report</li>
    </ol>
    <div class="row">
        <br>
        <form method="POST" action="/target_actor/submitreport" enctype="multipart/form-data">
            @csrf
            <table class="table table-bordered">
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td><input type="checkbox" name="incident_type[]" value="{{$type->name}}"> {{$type->name}}</td>
                        </tr>

                    @endforeach
                </tbody>
            </table>

            <table class="table table-bordered">
                <tbody>
                        <tr>
                            <td><b><label>Description</label></b><br>
                                <input type="text" name="description" />
                            </td>
                        </tr>

                </tbody>
            </table>   

            <input hidden name="latitude" id="latitude" value="">
            <input hidden name="longitude" id="longitude" value="">
            <input hidden name="legitimacy" id="legitimacy" value="">
            <input hidden name="response_status" id="response_status" value="">
            <table class="table table-bordered">
                <tbody>
                        <tr>
                            <td><b><label>Upload Images</label></b><br>
                                <input type="file" name="image" />
                            </td>
                        </tr>

                </tbody>
            </table> 

            <button id="submission" type="submit" onclick="return confirm('Are you sure about this?')">Submit</button>

       
        </form>
    </div>
</div>
<script>
document.getElementById("submission").addEventListener("click", getLocation())    
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}
    
function showPosition(position) {
    latitude = position.coords.latitude; 
    longitude = position.coords.longitude;
    document.getElementById("latitude").value = latitude;
    document.getElementById("longitude").value = longitude;
}
</script>

@endsection