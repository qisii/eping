@extends('layouts.master')
@section('title', 'View Users')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>View Users 
                <a href="{{url('admin/add-admin')}}" class="btn btn-primary btn-sm float-end">Add Admin</a>
                <small> </small>
                <a href="{{url('admin/add-eka')}}" class="btn btn-primary btn-sm float-end">Add Key Actor</a>
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
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <!-- <th>Delete</th> -->
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                    @if ($item->id != Auth::user()->id)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->first_name.' '.$item->last_name }}</td>
                            <td>
                                {{ $item->email }}
                            </td>
                           <!--  -->
                           <td>
                                @if ($item->role_as == 0)
                                    Target 
                                @elseif ($item->role_as == 1)
                                    Admin
                                @elseif ($item->role_as == 2)
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
                                <a href="{{ url('admin/edit/'.$item->id)}}" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                                <!-- <a href="{{ url('admin/delete/'.$item->id)}}" class="btn btn-danger">Delete</a> -->
                            </td>
                        </tr>
                    @endif
                    
                @endforeach
                
            </tbody>
        </table>
    </div>

</div>

@endsection