<?php

namespace App\Http\Controllers\KeyActor;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('key_actor.dashboard');
    }
}
