@extends('layouts.keyactor-master')
@section('title', 'Search Report')
@section('content')

<style>
    svg {
        display: none;
    }
</style>

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>Search Results
                <a href="{{url('key_actor/report/viewreport')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                {{-- <a href="{{url('key_actor/add-feed')}}" class="btn btn-primary btn-sm float-end">Add Feed</a> --}}
            </h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>
        
        <div class="col-md-5 my-auto">
            <form action="{{ url('key_actor/search-report') }}" method="GET" role="search">
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
                    <th>@sortablelink('incident_type', 'Incident Type')</th>
                    <th>@sortablelink('description', 'Description')</th>
                    <th>@sortablelink('response_status', 'Response')</th>
                    <th>@sortablelink('legitimacy', 'Legitimacy')</th>
                    <th>@sortablelink('created_at', 'Date Created')</th>
                    <th>@sortablelink('img_path', 'Image')</th>
                    <th>@sortablelink('updated_at', 'Date Updated')</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($search as $post)
                  
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->incident_type }}</td>
                        <td>{{ $post->description }}</td>
                        
                        <td>@if($post->response_status!= null)
                                @if($post->response_status == 1)
                                    <p>Responding</p>
                                @elseif($post->response_status == 2)
                                    <p>On the Scene</p>
                                @elseif($post->response_status == 3)
                                    <p>Case Closed</p>
                                @endif
                            @else
                                <p>Pending</p>
                            @endif
                        </td>
                        <td>
                        @if($post->legitimacy!= null)
                            @if($post->legitimacy == 1)
                                <p>True</p>
                            @elseif($post->legitimacy == 0)
                                <p>False</p>
                            @endif
                        @else
                            <p>Pending</p>
                        @endif
                        </td>
                        <td>{{ $post->created_at }}</td>
                        <td><img src ={{ $post->image_path }}></td>
                        <td>{{ $post->updated_at }}</td>
                        <td><a href="/key_actor/report/edit-report/{{ $post->id }}">Evaluate Report </a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No Reports Available</td>
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