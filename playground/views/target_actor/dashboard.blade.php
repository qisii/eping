@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Target Actor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
    
    <a href="{{ url('target_actor/submitreport') }}">Submit Report</a> <br><br>
    <a href="{{ url('target_actor/viewreport') }}">View My Reports</a> <br><br>
    
    <!-- NEWS AND UPDATE -->
    <h4>FEED</h4>
            <!-- HIGH PRIORITY -->
            <table class="table table-bordered">
                <h6>HIGH</h6>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Cover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($high as $h)
                    
                        <tr>
                            <td>{{ $h->title }}</td>
                            <td>{{ $h->description }}</td>
                            <td><img src="/FeedCover/{{ $h->cover}}" alt="" style="max-height:100px; max-width:100px; "></td>
                            <td><a href="/target_actor/view-feed/{{ $h->id }}">View</a></td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- MEDIUM PRIORITY -->
            <table class="table table-bordered">
                <h6>MEDIUM</h6>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Cover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medium as $m)
                    
                        <tr>
                            <td>{{ $m->title }}</td>
                            <td>{{ $m->description }}</td>
                            <td><img src="/FeedCover/{{ $m->cover}}" alt="" style="max-height:100px; max-width:100px; "></td>
                            <td><a href="/target_actor/view-feed/{{ $m->id }}">View</a></td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- LOW PRIORITY -->
            <table class="table table-bordered">
                <h6>LOW</h6>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Cover</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($low as $l)
                    
                        <tr>
                            <td>{{ $l->title }}</td>
                            <td>{{ $l->description }}</td>
                            <td><img src="/FeedCover/{{ $l->cover}}" alt="" style="max-height:100px; max-width:100px; "></td>
                            <td><a href="/target_actor/view-feed/{{ $l->id }}">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        <!-- EKA MODULES -->
        <br>
        <h4>MODULE</h4>
         <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Emergency Personnel</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                
            @foreach ($ekas as $eka)
                  
                 <tr>
                        <td>{{ $eka->first_name }}</td>
                        <td>{{ $eka->description }}</td>
                        <td><a href="/target_actor/view-mat/{{ $eka->id }}">View</a></td>
                       
                    </tr>
              @endforeach
                
            </tbody>
        </table>
    </div>
</div>

@endsection