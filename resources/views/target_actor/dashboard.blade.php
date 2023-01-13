@extends('layouts.targetactor-master')
@section('title', 'Eping Dashboard')
@section('content')

<div class="container-fluid px-4">
    <h1 class="mt-4">Hello {{ Auth::user()->first_name }}!</h1>



    <div class="row">
    
        <a href="{{ url('target_actor/submitreport') }}">Submit Report</a> <br><br>

    </div>
</div>

@endsection