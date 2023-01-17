@extends('layouts.keyactor-master')
@section('title', 'Key Actor Dashboard')
@section('content')
<style>
    .card-img {
        height: 50%;
    }
    .card-body {
        /* height: %; */
        /* height: 100% */
    }
    @media (max-width:500px) {
        .row {
            gap: 1em;
        }
    }

</style>
<div class="container-fluid px-4">
    <h1 class="mt-4">Hello, Key Actor</h1>
    <div class="alert alert-primary" role="alert">
        What would you like to do today?
    </div>
    <div class="row">
        <div class="col gr-col">
            <div class="card">
                <img src="/images/submit.jpg" class="card-img-top card-img h-100" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Emergency Reports</h5>
                    {{-- <p class="card-text">Create an Emergency Ticket for the authorities to respond.</p> --}}
                    <a href="{{ url('key_actor/report/viewreport') }}" class="btn btn-danger">View Emergency Reports</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <img src="/images/feeds.jpg" class="card-img-top card-img" alt="...">
            <div class="card-body">
                <h5 class="card-title">Feeds</h5>
                {{-- <p class="card-text">View Emergency Tickets that you've created</p> --}}

                <a href=" {{ url('key_actor/feed' )}}" class="btn btn-secondary">View Feeds</a>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <img src="/images/module.jpg" class="card-img-top card-img" alt="...">
            <div class="card-body">
                <h5 class="card-title">Modules</h5>
                {{-- <p class="card-text">View Legitimate Clustered reports in Eping</p> --}}
                <a href="{{ url('key_actor/material') }}" class="btn btn-secondary">View Modules</a>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection