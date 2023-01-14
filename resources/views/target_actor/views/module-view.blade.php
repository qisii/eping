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