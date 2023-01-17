@extends('layouts.targetactor-master')
@section('title', 'Profile')
@section('content')

<style>
    .files {
        border: 1px solid black;
    }
    .cover {
        width: 40%;
        border-radius: .5rem;
        border: 1px solid black;
    }
    @media (max-width:500px) {
        .cover {
            width: 100%;
        }
    }
</style>

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h5>Feed Title : <span class="fw-bold">{{$feeds->title}}</span>
                <a href="{{url('target_actor/feed-view')}}" class="btn btn-secondary btn-sm float-end"><i class="fa-solid fa-arrow-left-long mr-1"></i>Back</a>
                
            </h5>
        </div>

        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>
        
        {{-- <p>Feed Title: {{$feeds->title}}</p> --}}

        <div class="">
            <div class="mx-4">
                <label for="">Feed Description : </label>
                <div class="mx-1">{{$feeds->description}}</div>
            </div>
            <div class="card-body">
            {{-- <h5>Cover</h5> --}}
            <img src="/FeedCover/{{ $feeds->cover}}" alt="" class="cover">
            
            <br>
            <br>
            @if(count($feeds->feedFiles)>0)
            <h5>Feeds Files:</h5>
                <div class="d-flex gap-4">
                    @foreach($feeds->feedFiles as $feedFile)
                    <img class="files"src="/FeedFiles/{{ $feedFile->file}}" alt="" style="max-height:100px; max-width:100px; ">
                    
                    @endforeach

                </div>
            @endif
           
        </div>
    </div>

</div>

@endsection