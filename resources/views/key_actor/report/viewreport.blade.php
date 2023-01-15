@extends('layouts.keyactor-master')
@section('title', 'View Reports')
@section('content')

<div class="container-fluid px-4">


<div class="card mt-4">
        
        
        <div class="col-md-5 my-auto">
            <p>Search by Description</p>
            <form action="{{ url('key_actor/search-report') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="search" name="search" placeholder="Search" class="form-control">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        
        <form action="{{ url('key_actor/filter-report') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label>Filter by Created Date</label>
                    <input type="date" name="reportDate" class="form-control">
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
                        <option value="0"{{ Request::get('legitimacy')== '0'  ? 'selected':''}}>To be set</option>
                        <option value="1"{{ Request::get('legitimacy')== '1'  ? 'selected':''}}>True</option>
                        <option value="2"{{ Request::get('legitimacy')== '2'  ? 'selected':''}}>False</option>
                    </select>
                </div>
                    
                <div class="col-md-6">
                    <br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
    <div class="card mt-4">
        
        
        {{-- <div class="col-md-5 my-auto">
            <p>Search by Description</p>
            <form action="{{ url('key_actor/search-report') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="search" name="search" placeholder="Search" class="form-control">
                    <button type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div> --}}

{{--         
        <form action="{{ url('key_actor/filter-report') }}" method="GET">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label>Filter by Created Date</label>
                    <input type="date" name="reportDate" class="form-control">
                </div>
            </div>

            <div class="">
                <div class="col-md-3">
                    <label>Filter by</label>
                    <select name="response_status" id="" class="form-select">
                        <option value="">Select All Response Status</option>
                        <option value="0">Responding</option>
                        <option value="1">On the Scene</option>
                        <option value="2">Case closed</option>
                    </select>
                    <select name="legitimacy" id="" class="form-select">
                        <option value="">Select All Legitimacy</option>
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                </div>
                    
                <div class="col-md-6">
                    <br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form> --}}
        <table class="table table-bordered">
            <thead>
                <tr>
                <table class="table table-bordered">
            <thead>
                <tr>
                    <th>@sortablelink('incident_type', 'Incident Type')</th>
                    <th>@sortablelink('description', 'Description')</th>
                    <th>@sortablelink('response_status', 'Response')</th>
                    <th>@sortablelink('legitimacy', 'Legitimacy')</th>
                    <th>@sortablelink('created_at', 'Date Created')</th>
                    <th>@sortablelink('img_path', 'Image')</th>
                    <th>@sortablelink('updated_at', 'Date Updated')</th>
                    <th>Evaluate Report</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                  
                    <tr>
                        <td>{{ $post->incident_type }}</td>
                        <td>@if( $post->description != null)
                                <p>{{ $post->description }}</p>
                            @else
                                <strong><p>NO DESCRIPTION GIVEN BY THE USER</p></strong>
                            @endif
                        </td>
                        
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
                        @if($post->legitimacy== 0)
                            <p>To be set</p>
                        @elseif($post->legitimacy== 2)
                            <p>False</p>
                        @elseif($post->legitimacy== 1)
                            <p>True</p>
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
        <div>
        {{ $posts->links() }}   
        </div>
    </div>
    
</div>




























@endsection