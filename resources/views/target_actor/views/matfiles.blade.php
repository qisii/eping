@extends('layouts.targetactor-master')
@section('title', 'Create Material')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h5> Material Info
                {{-- <a href="{{url('target_actor/view-mat/'.$matfiles->created_by)}}" class="btn btn-primary btn-sm float-end">Go Back</a> --}}
                <a href="{{url('target_actor/module-view')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
            </h5>
        </div>

        <div>
            <div>{{$matfiles->title}}</div>
            {{-- <div>{{$matfiles->description}}</div> --}}

        </div>
       
        <div class="card-body">
            <h3>Material Files</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Material Title</th>
                        <th>Material Description</th>
                        <th>Download</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($matfiles->materialFiles as $materialFile)
                        <tr>
                            <td>{{ $materialFile->id }}</td>
                            <td>{{ $materialFile->file_title}}</td>
                            <td>{{ $materialFile->file_description}}</td>
                            <td><a href="{{url('/target_actor/downloadmaterialfile',$materialFile->file)}}">Download</a></td>
                            <td><a href="{{url('/target_actor/editmaterialfile',$materialFile->id)}}">View</a></td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
       
    </div>

</div>

@endsection