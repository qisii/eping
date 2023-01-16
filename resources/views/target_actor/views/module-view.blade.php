@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<style>
    tr td {
        width: 20%;
    }
</style>

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
                    <th>View</th>
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
                        <td><a class="btn btn-primary" href="/target_actor/managematerialfile/{{ $mat->id }}"><i class="fa-solid fa-magnifying-glass mr-1"></i>View</a></td>
                       
                    </tr>
              @endforeach
                
            </tbody>
        </table>
    </div>
</div>

@endsection