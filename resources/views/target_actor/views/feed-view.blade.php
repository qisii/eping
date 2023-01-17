@extends('layouts.targetactor-master')
@section('title', 'Blog Dashboard')
@section('content')
<style>
    tr th {
        width: 10%;
    }
    td {
        /* color: red; */
    }

    @media (max-width:550px) {
        p {
            font-size: 12px
        }
        h1 {
            font-size: 1.5rem;
        }
        h4 {
            font-size: 1rem;
        }

    }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4">Eping Feeds</h1>
    <div class="row">
    
    <!-- NEWS AND UPDATE -->
            <!-- HIGH PRIORITY -->
            <table class="table table-bordered">
                <h6><span class="badge bg-primary">HIGH</span></h6>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        {{-- <th>Cover</th> --}}
                        <th>Created by</th>
                        {{-- <th>Created at</th> --}}
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($high as $h)
                        
                        <tr>
                            <td><p>{{ $h->title }}</p></td>
                            <td><p>{{ $h->description }}</p></td>
                            {{-- <td><img src="/FeedCover/{{ $h->cover}}" alt="" style="max-height:100px; max-width:100px; "></td> --}}
                            <td>
                            @foreach($ekas as $user)
                                @if($h->created_by == $user->id)
                                    @if($user->role_as == 2)
                                        {{$user->first_name}}
                                    @else
                                        <strong><p>USER IS NO LONGER AN EKA</p></strong> 
                                    @endif
                                @endif
                            @endforeach
                            </td>
                            {{-- <td>{{ $h->created_at}}</td> --}}
                            <td><a class="btn btn-primary" href="/target_actor/view-feed/{{ $h->id }}"><i class="fa-solid fa-magnifying-glass mr-1"></i>View</a></td>
                        
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- MEDIUM PRIORITY -->
            <table class="table table-bordered">
                <h6><span class="badge bg-secondary">MEDIUM</span></h6>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        {{-- <th>Cover</th> --}}
                        <th>Created by</th>
                        <th>View</th>
                        {{-- <th>Created at</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($medium as $m)
                        <tr>
                            <td><p class="text-wrap">{{ $m->title }}</p></td>
                            <td><p>{{ $m->description }}</p></td>
                            {{-- <td><img src="/FeedCover/{{ $m->cover}}" alt="" style="max-height:100px; max-width:100px; "></td> --}}
                            <td>
                            @foreach($ekas as $user)
                                @if($m->created_by == $user->id)
                                    @if($user->role_as == 2)
                                        {{$user->first_name}}
                                    @else
                                        <p class="badge bg-warning text-dark text-wrap">User is no longer an EKA</p>
                                    @endif
                                @endif
                            @endforeach
                            </td>
                            {{-- <td>{{ $m->created_at}}</td> --}}
                            <td><a class="btn btn-primary" href="/target_actor/view-feed/{{ $m->id }}"><i class="fa-solid fa-magnifying-glass mr-1"></i>View</a></td>      
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- LOW PRIORITY -->
            <table class="table table-bordered">
                <h6><span class="badge bg-dark">LOW</span></h6>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        {{-- <th>Cover</th> --}}
                        <th>Created by</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($low as $l)
                        <tr>
                            <td><p>{{ $l->title }}</p></td>
                            <td><p>{{ $l->description }}</p></td>
                            {{-- <td><img src="/FeedCover/{{ $l->cover}}" alt="" style="max-height:100px; max-width:100px; "></td> --}}
                            <td>
                            @foreach($ekas as $user)
                                @if($l->created_by == $user->id)
                                    @if($user->role_as == 2)
                                        {{$user->first_name}}
                                    @else
                                        <strong><p class="fs-1 text-wrap">USER IS NO LONGER AN EKA</p></strong>
                                    @endif
                                @endif
                            @endforeach
                            </td>
                            <td><a class="btn btn-primary" href="/target_actor/view-feed/{{ $l->id }}"><i class="fa-solid fa-magnifying-glass mr-1"></i>View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>

@endsection