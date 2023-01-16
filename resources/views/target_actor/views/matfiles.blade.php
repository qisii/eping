@extends('layouts.targetactor-master')
@section('title', 'Create Material')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="fw-semibold"> {{$matfiles->title}}
                <a href="{{url('target_actor/module-view')}}" class="btn btn-secondary btn-sm float-end"><i class="fa-solid fa-arrow-left-long mr-1"></i>Back</a>
            </h5>
        </div>

        <div>
            <div></div>
            {{-- <div>{{$matfiles->description}}</div> --}}

        </div>
       
        <div class="card-body">
            <h3 class="">Module Files</h3>
            <br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        {{-- <th>ID</th> --}}
                        <th>Material Title</th>
                        <th>Material Description</th>
                        <th>Download</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matfiles->materialFiles as $materialFile)
                        <tr>
                            {{-- <td>{{ $materialFile->id }}</td> --}}
                            <td>{{ $materialFile->file_title}}</td>
                            <td>{{ $materialFile->file_description}}</td>
                            <td><a class="btn btn-success" href="{{url('/target_actor/downloadmaterialfile',$materialFile->file)}}"><i class="fa-solid fa-download"></i></a></td>
                            <td><a class="btn btn-info" href="{{url('/target_actor/editmaterialfile',$materialFile->id)}}"><i class="fa-solid fa-magnifying-glass"></i></a></td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>

</div>

@endsection