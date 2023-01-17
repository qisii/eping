@extends('layouts.master')
@section('title', 'Blog Dashboard')
@section('content')

<style>
    .card-img {
        height: 40%;
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
    <h1 class="mt-4">Hello, Admin {{ Auth::user()->first_name }}!!</h1>

    <div class="alert alert-primary" role="alert">
        What would you like to do today?
    </div>
    <div class="row">
        <div class="col gr-col">
            <div class="card">
                <img src="/images/submit.jpg" class="card-img-top card-img h-100" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Emergency Reports Tickets</h5>
                    {{-- <p class="card-text">Create an Emergency Ticket for the authorities to respond.</p> --}}
                    <a href="{{ url('admin/ticketreports') }}" class="btn btn-danger">View Reports Tickets</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
            <img src="/images/users.jpg" class="card-img-top card-img" alt="...">
            <div class="card-body">
                <h5 class="card-title">Users</h5>
                {{-- <p class="card-text">View Emergency Tickets that you've created</p> --}}

                <a href="{{ url('admin/users') }}" class="btn btn-secondary">Manage Users</a>
            </div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Primary Card</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div> --}}
</div>

@endsection