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
                    
                    <div>
                        <p>Title</p>
                        <input type="text" name="title">
                    </div>
                    <div>
                        <p>Description</p>
                        <textarea name="description"  cols="30" rows="5"></textarea>
                    </div>
                    <!-- <div>
                        <p>Save as draft: <input type="radio" name="material_stat" value="draft"></p>
                        <p>Publish now: <input type="radio" name="material_stat" value="active"></p>
                        
                    </div> -->
                    
                    <div>
                        <br>
                        <button name="submit">Submit</button>
                    </div>
                </form>
            </div>
            <!--  -->
        </div>
    </div>

</div>

@endsection