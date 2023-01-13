@extends('layouts.keyactor-master')
@section('title', 'Search Material')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>Search Results
                <a href="{{url('key_actor/material')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                {{-- <a href="{{url('key_actor/add-material')}}" class="btn btn-primary btn-sm float-end">Add Material</a> --}}
            </h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>

        <div class="col-md-5 my-auto">
            <form action="{{ url('key_actor/search-module') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="search" name="search" value="{{ Request::get('search') }}" placeholder="Search" class="form-control">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="80px">@sortablelink('id', 'ID')</th>
                    <th>@sortablelink('title', 'Topic')</th>
                    <th>@sortablelink('description', 'Description')</th>
                    <th>@sortablelink('created_at', 'Date Created')</th>
                    {{-- <th>@sortablelink('status', 'Status')</th> --}}
                    <th>@sortablelink('updated_at', 'Date Updated')</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                
            @forelse ($search as $mat)
                <tr>
                    <th scope="row">{{ $mat->id }}</th>
                    <td>{{ $mat->title }}</td>
                    <td>{{ $mat->description }}</td>
                    <td>{{ $mat->created_at }}</td>
                    {{-- <td>{{ $mat->status }}</td> --}}
                    <td>{{ $mat->updated_at }}</td><td>{{ $mat->description }}</td>
                    <td><a href="/key_actor/managematerialfile/{{$mat->id}}"> Update</a></td>
                    <td>
                        <form action="/key_actor/deletematerial/{{$mat->id}}" method="post">
                            <button onclick="return confirm('Are you sure?');" type="submit">Delete</button>
                            @csrf 
                            @method('delete')
                        </form>
                    </td>
                </tr>
                @empty
                    <tr>
                        <td colspan="5">No Results Found</td>
                    </tr>
              @endforelse
                
            </tbody>
        </table>
        <div>
            {{ $search->links() }}
        </div>
    </div>

</div>

@endsection