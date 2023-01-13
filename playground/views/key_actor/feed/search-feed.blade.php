@extends('layouts.keyactor-master')
@section('title', 'Search Feed')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>Search Results
                <a href="{{url('key_actor/feed')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                {{-- <a href="{{url('key_actor/add-feed')}}" class="btn btn-primary btn-sm float-end">Add Feed</a> --}}
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
                    <th>@sortablelink('title', 'Title')</th>
                    <th>@sortablelink('description', 'Description')</th>
                    <th>@sortablelink('type', 'Type')</th>
                    <th>@sortablelink('created_at', 'Date Created')</th>
                    <th>@sortablelink('exp_date', 'Expiration')</th>
                    <th>@sortablelink('cover', 'Cover')</th>
                    {{-- <th>@sortablelink('status', 'Status')</th> --}}
                    <th>@sortablelink('updated_at', 'Date Updated')</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($search as $feed)
                  
                    <tr>
                        <td>{{ $feed->id }}</td>
                        <td>{{ $feed->title }}</td>
                        <td>{{ $feed->description }}</td>
                        <td>{{ $feed->type }}</td>
                        <td>{{ $feed->created_at }}</td>
                        {{-- <td>{{ $feed->exp_date }}</td> --}}
                        <td>
                        @if ($feed->exp_date <= date('Y-m-d H:i:s'))
                            Inactive
                        @else 
                            Active
                        @endif
                        </td>    
                        <!-- <td>{{ $feed->cover }}</td> -->
                        <td><img src="FeedCover/{{ $feed->cover }}" alt="" style="max-height:100px; max-width:100px;"></td>
                        <td>{{ $feed->updated_at }}</td>
                        <td><a href="/key_actor/edit-feed/{{ $feed->id }}">Update</a></td>
                        <td>
                            <form action="/key_actor/deletefeed/{{$feed->id}}" method="post">
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
            </tbody>
        </table>
        <div>
            {{ $search->links() }}
        </div>
    </div>

</div>

@endsection