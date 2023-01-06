@extends('layouts.keyactor-master')
@section('title', 'View Reports')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>View Report 
                <a href="{{url('key_actor/add-feed')}}" class="btn btn-primary btn-sm float-end">Add Feed</a>
            </h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>
        
        <div class="col-md-5 my-auto">
            <form action="{{ url('key_actor/search-feed') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="search" name="search" placeholder="Search" class="form-control">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <form action="{{ url('key_actor/filter-feeds') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label>Filter by Created Date</label>
                    <input type="date" name="createdDate" class="form-control">
                </div>
                {{-- <div class="col-md-3">
                    <label>Filter by Expiry Date</label>
                    <input type="date" name="expiryDate" class="form-control">
                </div> --}}
            </div>

            <div class="">
                <div class="col-md-3">
                    <label>Filter by</label>
                    <select name="type" id="" class="form-select">
                        <option value="">Select All Type</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </div>
                    
                <div class="col-md-6">
                    <br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>

        </form>
        
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
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                  
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->incident_type }}</td>
                        <td>{{ $post->description }}</td>
                        
                        <td>@if($post->response_status!= null)
                                @if($post->response_status == 1)
                                    <p>OTW</p>
                                @elseif($post->response_status == 2)
                                    <p>On the Scene</p>
                                @elseif($post->response_status == 3)
                                    <p>Closed</p>
                                @endif
                            @else
                                <p>Pending</p>
                            @endif
                        </td>
                        <td>
                        @if($post->legitimacy!= null)
                            @if($post->legitimacy == 1)
                                <p>True</p>
                            @elseif($post->legitimacy == 2)
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
                        <td colspan="5">No Files Available</td>
                    </tr>
                @endforelse        
            </tbody>        
        </table>
    
    </div>

</div>




























@endsection