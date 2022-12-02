<?php

namespace App\Http\Controllers\KeyActor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// added
use App\Models\Material;
use App\Models\MaterialFiles;
use Illuminate\Support\Facades\DB;
use File;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        // $feeds = Feed::find($created_by);
        // return view('key_actor.feed.index', compact('feeds'));
        return view('key_actor.material.index');
    }

    public function create()
    {
        return view('key_actor.material.create');
    }

    public function storeMaterial(Request $request)
    {
        $mat = new Material([
            "title" => $request->title,
            "description" => $request->description,
            "status" => $request->status,
            "created_by" => Auth::user()->id,
        ]);
        $mat->save();
        return view('key_actor.material.index');
    }
}
