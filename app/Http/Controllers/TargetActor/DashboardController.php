<?php

namespace App\Http\Controllers\TargetActor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('target_actor.dashboard');
    }
}
