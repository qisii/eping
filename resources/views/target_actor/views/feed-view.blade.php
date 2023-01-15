@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Eping Feeds</h1>
    <div class="row">
    
    <!-- NEWS AND UPDATE -->
            <!-- HIGH PRIORITY -->
            <table class="table table-bordered">
                <h6>HIGH</h6>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Cover</th>
                        <th>Created by</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($high as $h)
                        
                        <tr>
                            <td>{{ $h->title }}</td>
                            <td>{{ $h->description }}</td>
                            <td><img src="/FeedCover/{{ $h->cover}}" alt="" style="max-height:100px; max-width:100px; "></td>
                            <td>
                            @foreach($ekas as $user)
                                @if($h->created_by == $user->id)
                                    @if($user->role_as == 2)
                                        {{$user->first_name}}
                                    @else
                                        sad
                                    @endif
                                @endif
                            @endforeach
                            </td>
                            <td>{{ $h->created_at}}</td>
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
                        <th>Created by</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medium as $m)
                        <tr>
                            <td>{{ $m->title }}</td>
                            <td>{{ $m->description }}</td>
                            <td><img src="/FeedCover/{{ $m->cover}}" alt="" style="max-height:100px; max-width:100px; "></td>
                            <td>
                            @foreach($ekas as $user)
                                @if($m->created_by == $user->id)
                                    @if($user->role_as == 2)
                                        {{$user->first_name}}
                                    @else
                                        USER IS NO LONGER AN EKA
                                    @endif
                                @endif
                            @endforeach
                            </td>
                            <td>{{ $m->created_at}}</td>
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
                        <th>Created by</th>
                        <th>Created at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($low as $l)
                        <tr>
                            <td>{{ $l->title }}</td>
                            <td>{{ $l->description }}</td>
                            <td><img src="/FeedCover/{{ $l->cover}}" alt="" style="max-height:100px; max-width:100px; "></td>
                            <td>
                            @foreach($ekas as $user)
                                @if($l->created_by == $user->id)
                                    @if($user->role_as == 2)
                                        {{$user->first_name}}
                                    @else
                                        USER IS NO LONGER AN EKA
                                    @endif
                                @endif
                            @endforeach
                            </td>
                            <td><a href="/target_actor/view-feed/{{ $l->id }}">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>

@endsection