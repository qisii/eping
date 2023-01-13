@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<style>
    .click {
        cursor: pointer;
    }
    table {
        width: 100%;
    }
    th {
        width: 10%;
        font-size: 12px
    }
    td {
        padding: 5px;
    }
    @media (max-width:550px) {
        p {
            font-size: 10px
        }

    }
</style>

<div class="container-fluid">
    <h1 class="mt-4">Target Actor</h1>
    <div> click to view location</div>
    <div class="card-body">
        @if (session('message'))
            <div class="alert alert-success">{{  session('message')  }}</div>
        @endif
    </div>

    <div class="row">
        <table class="table-bordered">
            <thead>
                <tr>
                <th scope="col">Emergency Type</th>
                <th scope="col">Description</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
                <th scope="col">Date</th>
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
                        <td>
                            @if($post->description != NULL)
                            <p>{{  $post->description  }}</p>
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
                            </td>
                        @endif
                        <td>
                            <p>This report was created at {{$post->created_at}} </p>

                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
</div>

@endsection