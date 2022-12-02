@extends('layouts.keyactor-master')
@section('title', 'View Material')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>View Material 
                <a href="{{url('key_actor/add-material')}}" class="btn btn-primary btn-sm float-end">Add Material</a>
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
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                
                
                
            </tbody>
        </table>
                </tr>
            </thead>
            <tbody>
               
                
            </tbody>
        </table>
    </div>

</div>

@endsection