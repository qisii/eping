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

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{$error}}</div>
                    @endforeach
                </div>
            @endif
        </div>
        <div>
            <!--  -->
            <div class="card-body">
            
            <h3>Material Files</h3>
            
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Material Title</th>
                        <th>Material Description</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matfiles->materialFiles as $materialFile)
                        <tr>
                            <td>{{ $materialFile->id }}</td>
                            <td>{{ $materialFile->file_title}}</td>
                            <td>{{ $materialFile->file_description}}</td>
                            <td><a href="{{url('/key_actor/editmaterialfile',$materialFile->id)}}">Edit</a></td>
                            <td>
                                <form action="/key_actor/deletematerialfile/{{$materialFile->id}}" method="post">
                                    <button onclick="return confirm('Are you sure?');" type="submit">Delete</button>
                                    @csrf 
                                    @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <hr>
        <div>
            <h3>Add Material Files</h3>
            <form action="/key_actor/storematerialfile" method="post" enctype="multipart/form-data">
                @csrf
               
                <div>
                    <input type="hidden" name="material_id" value="{{$matfiles->id}}">
                </div>
                <div class="row mb-3">
                    <label for="file_title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                    <div class="col-md-6">
                        <input id="file_title" type="text"  name="file_title" value="{{ old('file_title') }}" class="form-control" autofocus>

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
                        <textarea  cols="10" rows="5" id="file_description" type="text"  name="file_description" value="{{ old('file_description') }}" class="form-control" autofocus>{{ old('description') }}</textarea>

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
                        <input id="file" type="file"  name="file" value="{{ old('file') }}" class="form-control" autofocus multiple>

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
                            {{ __('Add Material File') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <hr>
        <div>
            <h3>Material Info</h3>
            
            <form action="/key_actor/updatematerial/{{ $matfiles->id}}" method="post" enctype="multipart/form-data">
                @csrf 
                @method("put")
                
            <div>

            <div class="row mb-3">
                <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                <div class="col-md-6">
                    <input id="title" type="text"  name="title" placeholder="{{$matfiles->title}}" class="form-control" autofocus>

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
                    <textarea  cols="10" rows="5" id="description" type="text"  name="description"  placeholder="{{$matfiles->description}}" class="form-control" autofocus>{{ old('description') }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <!-- <div>
                <p>Title</p>
                <input type="text" name="title" value="{{$matfiles->title}}">
            </div>
            <div>
                <p>Description</p>
                <textarea name="description"  cols="30" rows="10" value="{{$matfiles->description}}">{{$matfiles->description}}</textarea>
            </div> -->
           
            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Material') }}
                    </button>
                </div>
            </div>
        </form>
        </div>

            </div>
            <!--  -->
        </div>
    </div>

</div>

@endsection