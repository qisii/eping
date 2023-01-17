@extends('layouts.keyactor-master')
@section('title', 'Filter Material')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>Filter Material 
                <a href="{{url('key_actor/material')}}" class="btn btn-secondary float-end"><i class="fa-solid fa-arrow-left-long mr-1"></i>Back</a>
            </h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>
        
        {{-- <div class="col-md-5 my-auto">
            <form action="{{ url('key_actor/search-module') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="search" name="search" placeholder="Search" class="form-control">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div> --}}

        <form action="{{ url('key_actor/filter-module') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label>Filter by Date</label>
                    <input type="date" name="createdDate" value="{{ Request::get('createdDate') ?? date('Y-m-d') }}" class="form-control">
                </div>
            </div>

            <div class="">
                <div class="col-md-3">
                    {{-- <label>Filter by</label>
                    {{-- <select name="type" id="" class="form-select">
                        <option value="">Select All Type</option>
                        <option value="high"{{ Request::get('type')== 'high' ? 'selected':'' }}>High</option>
                        <option value="medium"{{ Request::get('type')== 'medium' ? 'selected':''}}>Medium</option>
                        <option value="low"{{ Request::get('type')== 'low' ? 'selected':''}}>Low</option>
                    </select> --}}
                    {{-- <select name="created_by" id="" class="form-select">
                        <option value="">Select All Creator</option>
                        <option value="1"{{ Request::get('created_by')== '1' ? 'selected':'' }}>Admin</option>
                        <option value="0"{{ Request::get('created_by')== '0' ? 'selected':''}}>Target User</option>
                    </select> --}}
                    {{-- <select name="status" id="" class="form-select">
                        <option value="">Select All Status</option>
                        <option value="0"{{ Request::get('status')== '0'  ? 'selected':''}}>Active</option>
                        <option value="1"{{ Request::get('status')== '1'  ? 'selected':''}}>Inactive</option>
                    </select>
                </div> --}}
                    
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
                
            @forelse ($mats as $mat)
                <tr>
                    <th scope="row">{{ $mat->id }}</th>
                    <td>{{ $mat->title }}</td>
                    <td>{{ $mat->description }}</td>
                    <td>{{ $mat->created_at }}</td>
                    {{-- <td>{{ $mat->status }}</td> --}}
                    <td>{{ $mat->updated_at }}</td>
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
                        <td colspan="5">No Materials Available</td>
                    </tr>
              @endforelse
                
            </tbody>
        </table>
        <div>
            {{ $mats->links() }}
        </div>
    </div>

</div>

@endsection