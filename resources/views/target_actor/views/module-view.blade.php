@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<div class="container-fluid px-4">
    <div class="row">
        <!-- EKA MODULES -->
        <br>
        <h4 class="my-4">Eping Modules</h4>
         <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Module Title</th>
                    <th>Module Description</th>
                    <th>Author</th>
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