@extends('layouts.targetactor-master')
@section('title', 'Create Material')
@section('content')
<style>
    iframe {
        width: 100%;
        height: 80vh;
    }
</style>
<div class="container-fluid px-1">

    <div class="card mt-4">
        <div class="card-header">
            <h5>{{$file->file_title}}
                <a href="{{url('/target_actor/managematerialfile/'. $file->material_id)}}" class="btn btn-secondary btn-sm float-end"><i class="fa-solid fa-arrow-left-long mr-1"></i>Back</a>
                
            </h5>
        </div>
        <div class="card-body">
            <div class="my-2">{{$file->file_description}}</div>
            <div class="files"><iframe src="\MaterialFiles\{{$file->file}}"></iframe></div>
        </div>
    </div>

</div>

@endsection