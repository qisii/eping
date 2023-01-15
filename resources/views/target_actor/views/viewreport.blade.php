@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<style>
    .click {
        cursor: pointer;
    }
    table {
        /* width: 90%; */
    }
    .container-fluid {
        padding: 0 2em;
    }
    th {
        width: 10%;
        padding: 1em
        /* font-size: 12px */
    }
    td {
        padding: 5px;
    }
    @media (max-width:550px) {
        p {
            font-size: 10px
        }
        h1 {
            font-size: 1.5rem;
        }
        h4 {
            font-size: 1rem;
        }

    }
</style>

<div class="container-fluid">
    <h1 class="mt-4">Emergency Report Tickets : </h1>
    {{-- <div class="card-body">
        @if (session('message'))
            <div class="alert alert-success">{{  session('message')  }}</div>
        @endif
    </div> --}}
    

    <div class="row">
        <h4><span class="badge bg-primary">Click ticket to view report</span></h4>
        <table class="table-bordered">
            <thead>
                <tr>
                <th scope="col">Report Emergency Type</th>
                <th scope="col">Report Description</th>
                <th scope="col">Report Status</th>
                <th scope="col">Report Logs</th>
                </tr>
            </thead>
            <form method="POST" enctype="multipart/form-data">
            @csrf
            @foreach ($posts as $post)
                <tbody>
                    <tr>
                        <td class="click" onclick="location.href='viewspec/{{$post->id}}'">
                                <p>{{ $post->incident_type}}</p>
                        </td>
                        <td>@if( $post->description != null)
                                <p>{{ $post->description }}</p>
                            @else
                                <p class="badge bg-warning text-dark">No description</p>
                            @endif
                        </td>
                        <td>
                            @if($post->response_status==1)
                                <p>A response Team is on your Way.
                                    Please wait in a safe area.
                                </p>
                            @elseif($post->response_status==2)
                                <p>The response Team is on the scene.</p>
                            @else
                                <p>Your report is to be seen</p>
                            @endif
                        </td>
                        @if($post->updated_at != $post->created_at && $post->response_status == 1)
                            <td>       
                                <p>This report was seen at {{$post->updated_at}} </p>
                            </td>
                        @elseif($post->updated_at != $post->created_at && $post->response_status == 2)
                            <td>
                                <p>The Response Team Arrived at {{$post->updated_at}} </p>
                                <p>This report was created at {{$post->created_at}} </p>
                            </td>
                        @endif
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</div>

@endsection