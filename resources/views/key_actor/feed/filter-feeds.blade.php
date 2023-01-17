@extends('layouts.keyactor-master')
@section('title', 'Filter Feed Results')
@section('content')


<style>

    svg {
        display: none;
    }
</style>

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>Filter Feed 
                <a href="{{url('key_actor/feed')}}" class="btn btn-secondary float-end"><i class="fa-solid fa-arrow-left-long mr-1"></i>Back</a>
            </h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>
        


        <form action="{{ url('key_actor/filter-feeds') }}" method="GET">
            @csrf
            <div class="">
                <div class="col-md-3">
                    <label>Filter by Created Date</label>
                    <input type="date" name="createdDate" value="{{ Request::get('createdDate') ?? " " }}" class="form-control">
                </div>
                {{-- <div class="col-md-3">
                    <label>Filter by Expiry Date</label>
                    <input type="date" name="expiryDate" value="{{ Request::get('expiryDate') ?? date('Y-m-d') }}" class="form-control">
                </div> --}}
            </div>

            <div class="">
                <div class="col-md-3">
                    <label>Filter by</label>
                    <select name="type" id="" class="form-select">
                        <option value="">Select All Type</option>
                        <option value="high"{{ Request::get('type')== 'high' ? 'selected':'' }}>High</option>
                        <option value="medium"{{ Request::get('type')== 'medium' ? 'selected':''}}>Medium</option>
                        <option value="low"{{ Request::get('type')== 'low' ? 'selected':''}}>Low</option>
                    </select>
                </div>
                    
                <div class="col-md-6">
                    <br>
                    <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-filter mr-1"></i>Filter</button>
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
                        <td><a class="btn btn-warning" href="/key_actor/edit-feed/{{ $feed->id }}"><i class="fa-solid fa-pen mr-1"></i>Update</a></td>
                        <td>
                            <form action="/key_actor/deletefeed/{{$feed->id}}" method="post">
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?');" type="submit"><i class="fa-solid fa-trash mr-1"></i>Delete</button>
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
            </tbody>
        </table>
        <div>
            {{ $feeds->links() }}
        </div>
    </div>

</div>

@endsection