@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Target Actor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">My Reports</li>
    </ol>
    <div class="row">
        <form method="POST" action="/target_actor/submitreport" enctype="multipart/form-data">
            @csrf
            @foreach ($posts as $post)
            <table class="table table-bordered">
                <tbody>
                        <tr>
                            <td>
                                <h3>{{ $post->incident_type}}</h3>
                            </td>

                            <td>
                                @if($post->description != NULL)
                                <h3>Description</h3>
                                <p>{{  $post->description  }}</p>
                                @endif
                                <img src="{{  url('storage/app/' . $post->image_path)  }}" />
                                <!-- <h2>{{  $post->id  }}</h2> -->
                            </td>
                            <td>
                                @if($post->response_status==1)
                                    <h2>A response Team is on your Way.
                                        Please wait in a safe area.
                                    </h2>
                                @elseif($post->response_status==2)
                                    <h2>The response Team is on the scene.</h2>
                                @else
                                    <h2>Your report is to be seen</h2>
                                @endif
                            </td>
                            @if($post->updated_at != $post->created_at && $post->response_status == 1)
                            <td>
                                
                                <h2>This report was seen at {{$post->updated_at}} </h2>
                                

                            </td>
                            @elseif($post->updated_at != $post->created_at && $post->response_status == 2)
                            <td>
                                
                                <h2>The Response Team Arrived at {{$post->updated_at}} </h2>
                                

                            </td>
                            @endif
                            <td>
                                <h2>This report was created at {{$post->created_at}} </h2>

                            </td>
                        </tr>

                </tbody>

            </table>
            @endforeach

       
        </form>
    </div>
</div>

@endsection