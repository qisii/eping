@extends('layouts.targetactor-master')
@section('title', 'Create Material')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h5>{{$file->file_title}}
                <a href="{{url('/target_actor/managematerialfile/'. $file->material_id)}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                
            </h5>
        </div>
        <div class="card-body">
            <div>{{$file->file_description}}</div>
            <div><iframe src="\MaterialFiles\{{$file->file}}"></iframe></div>
        </div>
    </div>

</div>

@endsection