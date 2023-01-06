@extends('layouts.keyactor-master')
@section('title', 'Create Material')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h5>Create Material
                <a href="{{url('key_actor/material')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                
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
            <form action="{{ url('key_actor/store-material' )}}" method="post" enctype="multipart/form-data">
                @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <small>{{ $error }}</small>
                                @endforeach
                            </ul>
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

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add Material') }}
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