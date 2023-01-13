@extends('layouts.keyactor-master')
@section('title', 'Key Actor Dashboard')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Key Actor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">Reports</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ url('key_actor/report/viewreport') }}">View Submitted Reports</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection