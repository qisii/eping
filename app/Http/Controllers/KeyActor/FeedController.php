<?php

namespace App\Http\Controllers\KeyActor;

use App\Models\Feed;
use App\Models\FeedFiles;

// added
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FeedController extends Controller
{
    // display feed
    public function index()
    {   
        $feeds = DB::table('feeds')->where('created_by', Auth::user()->id)->get();
        $feeds = Feed::sortable()->paginate(10);
        return view('key_actor.feed.index', compact('feeds'));
    }

    //search
    public function searchFeeds(Request $request)
    {
        if($request->search)
        {
            $search = Feed::where('id', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('title', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('description', 'LIKE', '%'.$request->search.'%')
                            // ->orWhere('cover', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('type', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('exp_date', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('created_at', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('created_by', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('updated_at', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('status', 'LIKE', '%'.$request->search.'%')
                            ->paginate(5);
            return view('key_actor.feed.search-feed', compact('search'));//index
        }
        else
        {
            return view('key_actor.feed.search-feed');//index
        }
    }

    public function filterFeeds(Request $request)
    {
        //$createdDate = Carbon::now()->format('Y-m-d');
        // $expiryDate = Carbon::now()->format('Y-m-d');
        $createdDate = $request->input('createdDate');
        //$expiryDate = $request->input('expiryDate');
        


        if($request->createdDate != null && $request->type != null){
            $feeds = Feed::whereDate('created_at', $request->createdDate)->Where('type', $request->type)
            ->sortable()
            ->paginate(5);
        }
        elseif($request->type != null){
            $feeds = Feed::where('type', $request->type)
            ->sortable()
            ->paginate(5);
        }
        elseif($request->createdDate != null){
            $feeds = Feed::whereDate('created_at', $request->createdDate)
            ->sortable()
            ->paginate(5);
        }

        else{
            $feeds = Feed::sortable()->paginate(5);
        }

        // $feeds = Feed::when($request->createdDate != null, function ($q) use ($request) {
        //                 return $q->whereDate('created_at', $request->createdDate);
        //             }, function ($q) use ($createdDate){
        //                 return $q->whereDate('created_at', $createdDate);
        //             })
        //             // ->when($request->expiryDate != null, function ($q) use ($request) {
        //             //     return $q->whereDate('exp_date', $request->expiryDate);
        //             // }, function ($q) use ($expiryDate){
        //             //     return $q->whereDate('exp_date', $expiryDate);
        //             // })
        //             ->when($request->type != null, function ($q) use ($request) {
        //                 return $q->where('type', $request->type);
        //             })
        //             // ->when($request->created_by != null, function ($q) use ($request) {
        //             //     return $q->where('created_by', $request->created_by);
        //             // })
        //             ->when($request->status != null, function ($q) use ($request) {
        //                 return $q->where('status', $request->status);
        //             })
        //             ->sortable()
        //             ->paginate(5);

        return view('key_actor.feed.filter-feeds', compact('feeds', 'createdDate'));
    }

    // view input to create feed
    public function create()
    {
        return view('key_actor.feed.create');
    }

    // view input to update feed
    public function editFeed($id)
    {
        $feeds = Feed::findorFail($id);
        return view('key_actor.feed.edit')->with('feeds', $feeds);
    }

    // store feed
    public function storeFeed(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:50', 'unique:feeds'],
            'type' => ['required'],
            'exp_date' => ['after_or_equal:now'],
            'cover'=> ['mimes:jpeg,jpg,png'],
            'description' => ['required', 'string', 'max:10000'],
            'files' => ['mimes:jpeg,jpg,png'],
            'files' => 'required|array',
            'files.*' => 'image|mimes:jpg,jpeg',
        ]);
       
       
        if ($request->hasFile("cover")){
            $file = $request->file("cover");
            $feedCover = time().'_'.$file->getClientOriginalName();
            $file->move(\public_path("FeedCover/"), $feedCover);

            $feed = new Feed([
                "title" => $request->title,
                "description" => $request->description,
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
        // $feeds = DB::table('feeds')->where('created_by', Auth::user()->id)->get();
        // return view('key_actor.feed.index', compact('feeds'))->with('message', 'Feed Added Successfully');
        $feeds = Feed::sortable()->paginate(10);
        return redirect("/key_actor/feed")->with('message', 'Feed Added Successfully');
    }

    // update feed
    public function updateFeed(Request $request, $id)
    {
        $feeds = Feed::findOrFail($id);
        if ($request->files or $request->title or $request->description or $request->exp_date or $request->cover  != ''){
            if($request->files != ''){
                if($request->hasFile("files")){
                    $files = $request->file("files");
                    foreach($files as $file){
                        $fileName = time().'_'.$file->getClientOriginalName();
                        $request["feed_id"] = $id;
                        $request["file"] = $fileName;
                        $file->move(\public_path("FeedFiles"), $fileName);
                        FeedFiles::create($request->all());
                    }
                }
            }

            if($request->title !=''){
                $validated = $request->validate([
                    'title' => ['required', 'string', 'max:50', 'unique:feeds'],
                ]);
                Feed::findOrFail($id)->update([
                    "title" => $request->title,
                ]);
            }

            if($request->description !=''){
                $validated = $request->validate([
                    'description' => ['string', 'max:1000'],
                ]);
                Feed::findOrFail($id)->update([
                    "description" => $request->description,
                ]);
            }

            if($request->exp_date !=''){
                $validated = $request->validate([
                    'exp_date' => ['after_or_equal:now'],
                ]);
                Feed::findOrFail($id)->update([
                    "exp_date" => $request->exp_date,
                ]);
            }

            if($request->cover !=''){
                $validated = $request->validate([
                    'cover'=> ['mimes:jpeg,jpg,png'],
                ]);
                if($request->hasFile("cover")){
                    if(File::exists("FeedCover/".$feeds->cover)) {
                        File::delete("FeedCover/".$feeds->cover);
                    }
                    $file = $request->file("cover");
                    $feeds->cover = time()."_".$file->getClientOriginalName();
                    $file->move(\public_path("/FeedCover"), $feeds->cover);
                    $request['cover'] = $feeds->cover; 
                
                }
                Feed::findOrFail($id)->update([
                    "cover" => $feeds->cover,
                ]);
            }  
            return redirect("/key_actor/edit-feed/".$id)->with('message', 'Feed Updated Succesfully');
        } else {
            return redirect("/key_actor/edit-feed/".$id);
        }
    }

    // delete feed cover
    public function  deleteFeedCover($id){
        $cover = Feed::findorFail($id)->cover;
        if(File::exists("FeedCover/".$cover)){
            File::delete("FeedCover/".$cover);
        }
        return back();
    }

    // delete feed images files
    public function  deleteFeedFile($id){
        $feeds = FeedFiles::findorFail($id);
        $feed_id = $feeds->feed_id;
        if(File::exists("images/".$feeds->file)){
            File::delete("images/".$feeds->file);
        }
        FeedFiles::find($id)->delete();
        return back();
    }

    // delete feed
    public function deleteFeed($id)
    {
        $feeds = Feed::findOrFail($id);
        if(File::exists("FeedCover/".$feeds->cover)){
            File::delete("FeedCover/".$feeds->cover);
        }
        $feedFiles = FeedFiles::where("feed_id",$feeds->id)->get();
        foreach($feedFiles as $feedFile){
            if (File::exists("FeedFiles/".$feedFile->file)){
                File::delete("FeedFiles/".$feedFile->file);
            }
        }
        $feeds->delete();
        return redirect("/key_actor/feed")->with('message', 'Feed Deleted Successfully');;
        
    }
    
}
