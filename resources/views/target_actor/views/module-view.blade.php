@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<div class="container-fluid px-4">
    <div class="row">
        <!-- EKA MODULES -->
        <br>
        <h4>MODULE</h4>
         <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Created by</th>
                </tr>
            </thead>
            <tbody>
                
            @foreach ($mats as $mat)
                 <tr>
                        <td>{{ $mat->title }}</td>
                        <td>{{ $mat->description }}</td>
                        <td>
                            @foreach($ekas as $user)
                                @if($mat->created_by == $user->id)
                                    @if($user->role_as == 2)
                                        {{$user->first_name}}
                                    @else
                                        USER IS NO LONGER AN EKA
                                    @endif
                                @endif
                            @endforeach
                        </td>
                        <td><a href="/target_actor/managematerialfile/{{ $mat->id }}">View</a></td>
                       
                    </tr>
              @endforeach
                
            </tbody>
        </table>
    </div>
</div>

@endsection