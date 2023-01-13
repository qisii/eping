@extends('layouts.master')
@section('title', 'View Users')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            @if (Auth::user()->id == $user->id)
            <h5>Update Profile
                <a href="{{url('admin/users')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                
            </h5>
            @else
            <h5>Update User
                <a href="{{url('admin/users')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                
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
            @if ($user->role_as == 0)
                <form action="{{ url('admin/update_user/'.$user->id) }}" method="POST">
            @elseif ($user->role_as == 1)
                <form action="{{ url('admin/update_admin/'.$user->id) }}" method="POST">
            @elseif ($user->role_as == 2)
                <form action="{{ url('admin/update_eka/'.$user->id) }}" method="POST">
                
            @endif
            
                @csrf 
                @method('PUT')
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </div>
                    @endif

                    <!-- TARGET ACTOR  -->
                    @if ($user->role_as == 0)
                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text"  name="first_name" placeholder="{{ $user->first_name }}" class="form-control"  autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text"  name="last_name" placeholder="{{ $user->last_name}}" class="form-control" autofocus>

                                @error('last_name')
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
                                <input id="password" type="password"  name="password" class="form-control" >

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

                        <div class="row mb-3">
                            <label for="phonenumber" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phonenumber" type="text"  name="phonenumber" placeholder="{{ $user->phonenumber}}" class="form-control" autofocus>

                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text"  name="address" placeholder="{{ $user->address }}" class="form-control" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="emergency_number1" class="col-md-4 col-form-label text-md-end">{{ __('Emergency Number 1') }}</label>

                            <div class="col-md-6">
                                <input id="emergency_number1" type="text"  name="emergency_number1" placeholder="{{ $user->emergency_number1 }}" class="form-control" autofocus>

                                @error('emergency_number1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="emergency_number2" class="col-md-4 col-form-label text-md-end">{{ __('Emergency Number 2') }}</label>

                            <div class="col-md-6">
                                <input id="emergency_number2" type="text"  name="emergency_number2" placeholder="{{ $user->emergency_number1 }}" class="form-control" autofocus>

                                @error('emergency_number2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="emergency_number2" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="emergency_number2" type="text"  name="emergency_number2" placeholder="{{ $user->emergency_number1 }}" class="form-control" autofocus> --}}
                                <select name="status" id="" class="form-select">
                                    <option value="{{ $user->status }}">{{ $user->status === 1 ? "Active" : "Inactive" }}</option>
                                    @if ($user->status == 1)
                                        <option value="0">Inactive</option>
                                    @elseif ($user->status == 0)
                                        <option value="1">Active</option>
                                    @endif
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    <!-- ADMIN -->
                    @elseif($user->role_as == 1)
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
                        <div class="row mb-3">
                            <label for="emergency_number2" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="emergency_number2" type="text"  name="emergency_number2" placeholder="{{ $user->emergency_number1 }}" class="form-control" autofocus> --}}
                                <select name="status" id="" class="form-select">
                                    <option value="{{ $user->status }}">{{ $user->status === 1 ? "Active" : "Inactive" }}</option>
                                    @if ($user->status == 1)
                                        <option value="0">Inactive</option>
                                    @elseif ($user->status == 0)
                                        <option value="1">Active</option>
                                    @endif
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                    <!-- KEY ACTOR -->
                    @elseif($user->role_as == 2)
                        <div class="row mb-3">
                            <label for="agency_name" class="col-md-4 col-form-label text-md-end">{{ __('Agency Name') }}</label>

                            <div class="col-md-6">
                                <input id="agency_name" type="text"  name="agency_name" placeholder="{{ $user->first_name}}" class="form-control" autofocus>

                                @error('agency_name')
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
                            <label for="phonenumber" class="col-md-4 col-form-label text-md-end">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="phonenumber" type="text"  name="phonenumber" placeholder="{{ $user->phonenumber }}" class="form-control" autofocus>

                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Location') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text"  name="address" placeholder="{{ $user->address }}" class="form-control" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <!-- <input id="description" type="text"  name="description" placeholder="{{ $user->description }}" class="form-control" autofocus> -->
                                <textarea  cols="10" rows="5" id="description" type="text"  name="description" placeholder="{{ $user->description }}" class="form-control" autofocus></textarea>

                                @error('description')
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

                        <div class="row mb-3">
                            <label for="emergency_number2" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                {{-- <input id="emergency_number2" type="text"  name="emergency_number2" placeholder="{{ $user->emergency_number1 }}" class="form-control" autofocus> --}}
                                <select name="status" id="" class="form-select">
                                    <option value="{{ $user->status }}">{{ $user->status === 1 ? "Active" : "Inactive" }}</option>
                                    @if ($user->status == 1)
                                        <option value="0">Inactive</option>
                                    @elseif ($user->status == 0)
                                        <option value="1">Active</option>
                                    @endif
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    
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