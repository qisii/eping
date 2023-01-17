@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<style>
</style>
<div class="container-fluid px-4">
    <h1 class="my-4">Emergency Report</h1>
    <ol class="breadcrumb alert-info mb-4">
        <li class="">Fill Up Report Form</li>
    </ol>
    <div class="row">
        <br>
        <form method="POST" action="/target_actor/submitreport" enctype="multipart/form-data">
            @csrf
            <table class="table table-borderless">


                
                
                <tbody>
                    <tr >
                        <label class="fw-bold ml-2" for="">Report Type : </label>
                        <td><input class="boxes" type="checkbox" name="incident_type[]" value="Crime" onclick='deRequireCb("boxes")' required> Crime</td>
                        <td><input class="boxes" type="checkbox" name="incident_type[]" value="Natural Disaster" onclick='deRequireCb("boxes")' required> Natural Disaster</td> 
                        <td><input class="boxes" type="checkbox" name="incident_type[]" value="Medical Nature" onclick='deRequireCb("boxes")' required>Medical Nature</td>   
                    </tr>
                </tbody>
                
            </table>

            <table class="table table-borderless">
                <tbody>
                        <tr>
                            <td><b><label>Report Description : </label></b><br>
                                {{-- <input type="text"  /> --}}
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" placeholder="Emergency Report Description"></textarea>
                            </td>
                        </tr>

                </tbody>
            </table>   

            <input hidden name="latitude" id="latitude" value="">
            <input hidden name="longitude" id="longitude" value="">

            <table class="table table-borderless">
                <tbody>
                        <tr>
                            <td><b><label>Upload Image/s : </label></b><br>
                                <input class="form-control" type="file" id="formFile name="image"">
                                {{-- <input type="file" name="image" /> --}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-success" id="submission" type="submit" onclick="return confirm('Are you sure about this?')">Submit</button>
                            </td>
                        </tr>
                </tbody>
            </table> 


       
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
function deRequireCb(elClass) {
  el = document.getElementsByClassName(elClass);

  var atLeastOneChecked = false; //at least one cb is checked
  for (i = 0; i < el.length; i++) {
    if (el[i].checked === true) {
      atLeastOneChecked = true;
    }
  }

  if (atLeastOneChecked === true) {
    for (i = 0; i < el.length; i++) {
      el[i].required = false;
    }
  } else {
    for (i = 0; i < el.length; i++) {
      el[i].required = true;
    }
  }
}
</script>

@endsection