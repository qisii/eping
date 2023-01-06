@extends('layouts.targetactor-master')
@section('title', 'Profile')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h5>Update Feed
                <a href="{{url('target_actor/dashboard')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                
            </h5>
        </div>

        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>
        
        <div>
            <div class="card-body">
            <h5>Cover</h5>
            <img src="/FeedCover/{{ $feeds->cover}}" alt="" style="max-height:100px; max-width:100px; ">
            
            <br>
            <br>
            @if(count($feeds->feedFiles)>0)
            <h5>Feeds Files:</h5>
                @foreach($feeds->feedFiles as $feedFile)
                <img src="/FeedFiles/{{ $feedFile->file}}" alt="" style="max-height:100px; max-width:100px; ">
                
                @endforeach
            @endif
           
        </div>

        <hr>
        <div>
            <div>{{$feeds->title}}</div>
            <div>{{$feeds->description}}</div>
            <div></div>

            
        </div>
    </div>

</div>

@endsection