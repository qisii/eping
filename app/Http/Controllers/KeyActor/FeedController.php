<?php

namespace App\Http\Controllers\KeyActor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// added
use Illuminate\Support\Facades\Auth;
use App\Models\Feed;
use App\Models\FeedFiles;
use Illuminate\Support\Facades\DB;
use File;

class FeedController extends Controller
{
    
    
    public function index()
    {
        
        return view('key_actor.feed.index');
    }

    public function create()
    {
        return view('key_actor.feed.create');
    }

    public function storeFeed(Request $request)
    {
       
        if ($request->hasFile("cover")){
            $file = $request->file("cover");
            $feedCover = time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("FeedCover/"), $feedCover);

            $feed = new Feed([
                "title" => $request->title,
                "desciption" => $request->desciption,
                "type" => $request->type,
                "exp_date" => $request->exp_date,
                "stat" => $request->feed_stat,
                "cover" => $feedCover,
                "created_by" => Auth::user()->id,
            ]);
            $feed->save();
        }

        if ($request->hasFile("files")){
            $files = $request->file("files");
            foreach ($files as $file){
                $feedFile = time().'_'.$file->getClientOriginalName();
                $request['feed_id'] = $feed->id;
                $request['file'] = $feedFile;
                $file->move(\public_path("/FeedFiles"), $feedFile);
                FeedFiles::create($request->all());
            }
        }
        return view('key_actor.feed.index');
    }
}
