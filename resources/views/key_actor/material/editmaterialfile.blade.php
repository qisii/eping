@extends('layouts.keyactor-master')
@section('title', 'Create Material')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h5>Create Material
                <a href="{{url('/key_actor/managematerialfile/'. $file->material_id)}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                
            </h5>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>

        <p>Material Title: {{$file->title}}</p>

        <div>
            <!--  -->
            <div class="card-body">
            <form action="/key_actor/updatematerialfile/{{ $file->id}}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")
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
                        <label for="file_title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                        <div class="col-md-6">
                            <input id="file_title" type="text"  name="file_title" placeholder="{{$file->file_title}}" class="form-control" autofocus>

                            @error('file_title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="file_description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                        <div class="col-md-6">
                            <textarea  cols="10" rows="5" id="file_description" type="text"  name="file_description" placeholder="{{$file->file_description}}" class="form-control" autofocus>{{ old('description') }}</textarea>

                            @error('file_description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="file" class="col-md-4 col-form-label text-md-end">{{ __('Files') }}</label>

                        <div class="col-md-6">
                            <input id="file" type="file"  name="file"  class="form-control" autofocus multiple>
                            <iframe src="\MaterialFiles\{{$file->file}}"></iframe>

                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Material File') }}
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