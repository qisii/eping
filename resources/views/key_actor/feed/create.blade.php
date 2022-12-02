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
                        <p>Title:</p>
                        <input type="text" name="title">
                    </div>
                    <div>
                        <p>Description:</p>
                        <input type="text" name="description">
                    </div>
                    <div>
                        <p>Cover:</p>
                        <input type="file" name="cover">
                    </div>
                    <div>
                        <p>Files:</p>
                        <input type="file" name="files[]" multiple>
                    </div>
                    <div>
                        <p>Feed Type:</p>
                        <select name="type" id="">
                            <option value=""></option>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div>
                        <p>Expiry Date:</p>
                        <input type="datetime-local" name="exp_date">
                    </div>
                    <!-- <div>
                        <p>Save as draft: <input type="radio" name="status" value="draft"></p>
                        <p>Publish now: <input type="radio" name="status" value="active"></p>
                        
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