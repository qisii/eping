@extends('layouts.keyactor-master')
@section('title', 'View Feed')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>View Feed 
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
                    {{-- <select name="created_by" id="" class="form-select">
                        <option value="">Select All Creator</option>
                        <option value="1"{{ Request::get('created_by')== '1' ? 'selected':'' }}>Admin</option>
                        <option value="0"{{ Request::get('created_by')== '0' ? 'selected':''}}>Target User</option>
                    </select> --}}
                    {{-- <select name="status" id="" class="form-select">
                        <option value="">Select All Status</option>
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                    </select> --}}
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
                @forelse ($feeds as $feed)
                  
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
                        {{-- <td>{{ $feed->status }}</td> --}}
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
                        <td colspan="5">No Files Available</td>
                    </tr>
                @endforelse        
            </tbody>        
        </table>
        <div>
            {{ $feeds->links() }}
        </div>
    </div>

</div>

@endsection