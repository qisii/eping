@extends('layouts.keyactor-master')
@section('title', 'Profile')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h5>Create Feed
                <a href="{{url('key_actor/feed')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                
            </h5>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>
        <div>
            <!--  -->
            <div class="card-body">
            <form action="{{ url('key_actor/store-feed' )}}" method="post" enctype="multipart/form-data">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{$error}}</div>
                        @endforeach
                    </div>
                @endif

                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text"  name="title" value="{{ old('title') }}" class="form-control" autofocus>

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                        <div class="col-md-6">
                            <textarea  cols="10" rows="5" id="description" type="text"  name="description" value="{{ old('description') }}" class="form-control" autofocus>{{ old('description') }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="cover" class="col-md-4 col-form-label text-md-end">{{ __('Cover') }}</label>

                        <div class="col-md-6">
                            <input id="cover" type="file"  name="cover" value="{{ old('cover') }}" class="form-control" autofocus>

                            @error('cover')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="files" class="col-md-4 col-form-label text-md-end">{{ __('Files') }}</label>

                        <div class="col-md-6">
                            <input id="files" type="file"  name="files[]" value="{{ old('files[]') }}" class="form-control" autofocus multiple>

                            @error('files')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>

                        <div class="col-md-6">
                           
                            <select id="type" type="text"  name="type"  class="form-control" autofocus>
                                <option value="{{ old('type') }}"></option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="exp_date" class="col-md-4 col-form-label text-md-end">{{ __('Expiry Date') }}</label>

                        <div class="col-md-6">
                            <input id="exp_date" type="datetime-local"  name="exp_date" value="{{ old('exp_date') }}" class="form-control" autofocus>

                            @error('exp_date')
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
            <!--  -->
        </div>
    </div>

</div>

@endsection