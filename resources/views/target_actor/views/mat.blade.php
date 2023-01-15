@extends('layouts.targetactor-master')
@section('title', 'View Material')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>View Material 
                <a href="{{url('target_actor/module-view')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
            </h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>

        
        <table class="table table-bordered">
            <thead>
                <tr>
                <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Topic</th>
                    <th>Description</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                
            @foreach ($mats as $mat)
                 <tr>
                    <td>{{ $mat->id }}</td>
                    <td>{{ $mat->title }}</td>
                    <td>{{ $mat->description }}</td>
                    <td><a href="/target_actor/managematerialfile/{{$mat->id}}"> View</a></td> 
                </tr>
              @endforeach
                
            </tbody>
        </table>
    </div>

</div>

@endsection