@extends('layouts.master')
@section('title', 'View Users')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            @if (Auth::user()->id == $user->id)
            <h5>Update Profile
                <a href="{{url('admin/users')}}" class="btn btn-secondary btn-sm float-end"><i class="fa-solid fa-arrow-left-long mr-1"></i>Back</a>
                
            </h5>
            @else
            <h5>Update User
                <a href="{{url('admin/users')}}" class="btn btn-primary btn-sm float-end"><i class="fa-solid fa-arrow-left-long mr-1"></i>Back</a>
                
            </h5>

            @endif
            
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>
        <div>
            <!--  -->
            <div class="card-body">
           
                <form action="{{ url('admin/update_admin/'.$user->id) }}" method="POST">
            
                @csrf 
                @method('PUT')
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </div>
                    @endif

                        <div class="row mb-3">
                            <label for="user_name" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="user_name" type="text"  name="user_name" placeholder="{{ $user->first_name }}" class="form-control" autofocus>

                                @error('user_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="text"  name="email" placeholder="{{ $user->email }}" class="form-control" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"  name="password" class="form-control">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                            </div>
                        </div>
                      

                    
                    
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save Changes') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection