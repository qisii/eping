@extends('layouts.master')
@section('title', ' Search Users')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>Search Results
                <a href="{{url('admin/users')}}" class="btn btn-secondary float-end"><i class="fa-solid fa-arrow-left-long mr-1"></i>Back</a>
                {{-- <a href="{{url('admin/add-user')}}" class="btn btn-primary btn-sm float-end">Add Target User</a>
                <a href="{{url('admin/add-admin')}}" class="btn btn-primary btn-sm float-end">Add Admin</a>
                <a href="{{url('admin/add-eka')}}" class="btn btn-primary btn-sm float-end">Add Key Actor</a> --}}
            </h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>

        <div class="col-md-5 my-auto">
        <form action="{{ url('admin/search') }}" method="GET" role="search">
            <div class="input-group">
                <input required type="search" name="search" value="{{ Request::get('search') }}" placeholder="Search" class="form-control">
                <button class="btn btn-secondary "type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
        </div>
        <br>

        {{-- @forelse ($searched as $item) --}}
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th width="80px">@sortablelink('id', 'ID')</th>
                        <th>@sortablelink('first_name', 'Username')</th>
                        <th>@sortablelink('email', 'Email')</th>
                        <th>@sortablelink('address', 'Address')</th>
                        <th>@sortablelink('role_as', 'Role')</th>
                        <th>@sortablelink('created_at', 'Dated Registered')</th>
                        <th>@sortablelink('created_by', 'Registered by')</th>
                        <th>@sortablelink('status', 'Status')</th>
                        <th>Actions</th>
                        <!-- <th>Delete</th> -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($search as $item)
                        @if ($item->id != Auth::user()->id)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->first_name.' '.$item->last_name }}</td>
                                <td>
                                    {{ $item->email }}
                                </td>
                                <td>{{ $item->address }}</td>
                            <!--  -->
                                <td>
                                    @if ($item->role_as == 0)
                                        Target User
                                    @elseif ($item->role_as == 1)
                                        Admin
                                    @elseif ($item->role_as == 2)
                                        Key Actor
                                        
                                    @endif
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    @if ($item->created_by == 0)
                                        Target User
                                    @elseif ($item->created_by == 1)
                                        Admin
                                    @elseif ($item->created_by == 2)
                                        Key Actor
                                        
                                    @endif
                                </td>

                                <td>
                                    @if ($item->status == 0)
                                        Inactive
                                    @elseif ($item->status== 1)
                                        Active
                                        
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ url('admin/edit/'.$item->id)}}" class="btn btn-warning"><i class="fa-solid fa-pen mr-1"></i>Update</a>
                                    <a href="{{ url('admin/delete/'.$item->id) }}" onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-danger"><i class="fa-solid fa-trash mr-1"></i>Delete</a>
                                    <!-- <a href="{{ url('admin/delete/'.$item->id)}}" class="btn btn-danger">Delete</a> -->
                                </td>
                            </tr>
                            @endif
                        @empty
                        <tr>
                            <td colspan="5">No Results Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        {{-- @endforelse --}}
        <div>
            {{-- {{ $users->appends(['search' => request()->query('search')])->links() }} --}}
            {{ $search->links() }}
        </div>
    </div>

</div>

@endsection