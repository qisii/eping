@extends('layouts.targetactor-master')
@section('title', 'Eping Dashboard')
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
    <h1 class="my-4">Hello, {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}!</h1>
    <div class="alert alert-primary" role="alert">
        What would you like to do today?
    </div>
    {{-- <div class="row">
        <div class="col">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">Special title treatment</h5>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col gr-col">
            <div class="card">
                <img src="/images/submit.jpg" class="card-img-top card-img h-100" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Emergency Report</h5>
                    <p class="card-text">Creaete Report for the authorities to respond.</p>
                    <a href="{{ url('target_actor/submitreport') }}" class="btn btn-danger">Create Report</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <img src="/images/reports.jpg" class="card-img-top card-img" alt="...">
            <div class="card-body">
                <h5 class="card-title">View My Reports</h5>
                <p class="card-text">View Emergency Tickets that you've created</p>

                <a href="{{ url('target_actor/viewreport') }}" class="btn btn-secondary">View Reports</a>
            </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <img src="/images/map.jpg" class="card-img-top card-img" alt="...">
            <div class="card-body">
                <h5 class="card-title">View Awareness Map</h5>
                <p class="card-text">View Legitimate Clustered reports in Eping</p>
                <a href="{{ url('target_actor/viewlegit') }}" class="btn btn-success">View Awareness Map</a>
            </div>
            </div>
        </div>
    </div>


    {{-- <div class="row">
    
        <a href="{{ url('target_actor/submitreport') }}">Submit Report</a> <br><br>

    </div> --}}
</div>

@endsection