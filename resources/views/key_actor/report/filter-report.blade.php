@extends('layouts.keyactor-master')
@section('title', 'Filter Report')
@section('content')

<div class="container-fluid px-4">

    <div class="card mt-4">
        <div class="card-header">
            <h4>Filter Results
                <a href="{{url('key_actor/report/viewreport')}}" class="btn btn-primary btn-sm float-end">Go Back</a>
                {{-- <a href="{{url('key_actor/add-feed')}}" class="btn btn-primary btn-sm float-end">Add Feed</a> --}}
            </h4>
        </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message')}}</div>
            @endif
        </div>
        
        {{-- <div class="col-md-5 my-auto">
            <form action="{{ url('key_actor/search-report') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="search" name="search" value="{{ Request::get('search') }}" placeholder="Search" class="form-control">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div> --}}
        <form action="{{ url('key_actor/filter-report') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label>Filter by Created Date</label>
                    <input type="date" name="reportDate" value="{{ Request::get('reportDate') ?? " " }}" class="form-control">
                </div>
                {{-- <div class="col-md-3">
                    <label>Filter by Expiry Date</label>
                    <input type="date" name="expiryDate" class="form-control">
                </div> --}}
            </div>

            <div class="">
                <div class="col-md-3">
                    <label>Filter by</label>
                    <select name="response_status" id="" class="form-select">
                        <option value="">Select All Response Status</option>
                        <option value="1"{{ Request::get('response_status')== '1' ? 'selected':'' }}>Responding</option>
                        <option value="2"{{ Request::get('response_status')== '2' ? 'selected':''}}>On the Scene</option>
                        <option value="3"{{ Request::get('response_status')== '3' ? 'selected':''}}>Case closed</option>
                        <option value="0" {{ Request::get('response_status') == '0' ? 'selected':''}}>Pending</option>
                    </select>
                    {{-- <select name="created_by" id="" class="form-select">
                        <option value="">Select All Creator</option>
                        <option value="1"{{ Request::get('created_by')== '1' ? 'selected':'' }}>Admin</option>
                        <option value="0"{{ Request::get('created_by')== '0' ? 'selected':''}}>Target User</option>
                    </select> --}}
                    <select name="legitimacy" id="" class="form-select">
                        <option value="">Select All Legitimacy</option>
                        <option value="1"{{ Request::get('legitimacy')== '1'  ? 'selected':''}}>True</option>
                        <option value="2"{{ Request::get('legitimacy')== '2'  ? 'selected':''}}>False</option>
                    </select>
                </div>
                    
                <div class="col-md-6">
                    <br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
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
                @forelse ($posts as $post)
                  
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>{{ $post->incident_type }}</td>
                        <td>{{ $post->description }}</td>
                        
                        <td>@if($post->response_status != null)
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
                        @if($post->legitimacy != null)
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
                        <td><a href="/key_actor/report/edit-report/{{ $post->id }}">Evaluate Report</a></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No Reports Available</td>
                    </tr>
                @endforelse        
            </tbody>     
               
        </table>
        <div>
        {{ $posts->links() }}   
        </div>
    </div>
    
</div>
@endsection