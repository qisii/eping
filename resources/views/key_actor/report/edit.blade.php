@extends('layouts.keyactor-master')
@section('title', 'View Reports')
@section('content')

<br>
<br>
<br>


<div>

    <table class="table table-bordered">
        <thead>
            <tr>
            <table class="table table-bordered">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Emergency Number 1</th>
                <th>Emergency Number 2</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>  
                <tr>
                    <td>{{ $posts->first_name }}</td>
                    <td>{{ $posts->last_name }}</td>
                    <td>{{ $posts->phonenumber }}</td>
                    
                    <td>{{ $posts->emergency_number1 }}</td>
                    <td>{{ $posts->emergency_number2 }}</td>
                    <td>{{ $posts->address }}</td>
                </tr>       
        </tbody>     
           
    </table>









    <form action="/key_actor/report/updatereport/{{ $posts->id}}" method="post" enctype="multipart/form-data">
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
                <textarea  cols="10" rows="5" id="description" type="text"  name="description"  placeholder="{{$posts->description}}" class="form-control" autofocus></textarea>

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
                        @endif
                    </option>
                    @if($posts->response_status==1)
                       
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
                        @if($posts->legitimacy== NULL)
                            To be set
                        @elseif($posts->legitimacy==1)
                            True
                        @elseif($posts->legitimacy==2)
                            False
                        @endif
                    </option>
                    @if($posts->legitimacy== NULL)
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


















@endsection