<?php

namespace App\Http\Controllers\TargetActor;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// added
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Feed;
use App\Models\Post;
use App\Models\FeedFiles;
use App\Models\Material;
use App\Models\MaterialFiles;
use Illuminate\Support\Facades\DB;
use Posts;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{
    public function index()
    {
        $date = date('Y-m-d H:i:s');
        // $feeds = Feed::all();
        $high = DB::table('feeds')->where('type',  '=', 'high')->where('exp_date',  '>=', $date)->orderBy('exp_date', 'desc')->get();
        $medium = DB::table('feeds')->where('type',  '=', 'medium')->where('exp_date',  '>=', $date)->orderBy('exp_date', 'desc')->get();
        $low = DB::table('feeds')->where('type',  '=', 'low')->where('exp_date',  '>=', $date)->orderBy('exp_date', 'desc')->get();
        $ekas = DB::table('users')->where('role_as',  '=', '2')->orderBy('first_name', 'desc')->get();
        return view('target_actor.dashboard', compact('high', 'medium','low', 'ekas'));
        
    }

    public function indexFeed()
    {
        $date = date('Y-m-d H:i:s');
        // $feeds = Feed::all();
        $high = DB::table('feeds')->where('type',  '=', 'high')->where('exp_date',  '>=', $date)->orderBy('exp_date', 'desc')->get();
        $medium = DB::table('feeds')->where('type',  '=', 'medium')->where('exp_date',  '>=', $date)->orderBy('exp_date', 'desc')->get();
        $low = DB::table('feeds')->where('type',  '=', 'low')->where('exp_date',  '>=', $date)->orderBy('exp_date', 'desc')->get();
        $ekas = DB::table('users')->where('role_as',  '=', '2')->orWhere('role_as',  '=', '0')->orderBy('first_name', 'desc')->get();
        return view('target_actor.views.feed-view', compact('high', 'medium','low', 'ekas'));   
    }

    public function indexModule()
    {
        $mats = Material::all();
        $creator = DB::table('materials')->where('created_by');
        $ekas = DB::table('users')->where('role_as',  '=', '2')->orWhere('role_as',  '=', '0')->orWhere('role_as',  '=', '1')->orderBy('first_name', 'desc')->get();
        return view('target_actor.views.module-view', compact('ekas', 'mats', 'creator'));
    }

    public function viewFeed($id)
    {
        $feeds = Feed::findorFail($id);
        return view('target_actor.views.feed')->with('feeds', $feeds);
    }

    public function viewMaterial($id)
    {
        $mats = DB::table('materials')->where('created_by', '=', $id)->orderBy('title', 'desc')->get();
        return view('target_actor.views.mat')->with('mats', $mats);
    }
    // view manage material file
    public function manageMaterialFile($id)
    {
        $matfiles = Material::findorFail($id);
        return view('target_actor.views.matfiles')->with('matfiles', $matfiles);
    }

    public function editMaterialFile($id)
    {
        $file = MaterialFiles::findorFail($id);
        return view('target_actor.views.viewmatfiles', compact('file'));
    }
    public function downloadMaterial(Request $request,$file )
    {
        return response()->download(public_path('MaterialFiles/'.$file));
    }
    public function submitReport() {
        $types = DB::table('incident_types')->get('name');
        return view('target_actor.views.submitreport', compact('types'));
    }
    public function upload(Request $request) {
        $types = DB::table('incident_types')->get('name');
        $request->validate([
            'incident_type'=>'required'
        ]);

        $file = new Post();
        $file->description = $request->description;
        $file->incident_type = json_encode($request->incident_type);
        $file->latitude = $request->latitude;
        $file->response_status = 0;
        $file->longitude = $request->longitude;
        $file->legitimacy = 0;
        $file->user_id= Auth::id();
        $newFile = $request->file('image');
        if($newFile) {
            $file_path = $newFile->store('images');
            $file->image_path = $file_path;
            $file->save();
        }
        $file->save();
        
        return redirect("/target_actor/viewreport")->with('message', 'Report Submitted Successfully');
    }
    public function viewReport() 
    {
        $currentuser = Auth::id();
        $posts = Post::where('user_id', $currentuser)->get();
        return view('target_actor.views.viewreport', compact('posts'));
    }
    public function specreport($id){

        $posts = Post::findorFail($id);

        return view('target_actor.views.viewspec')->with('posts', $posts);

    }
    public function legitreports(){
        $posts = Post::select('*')->where('legitimacy', '=', '1')
                ->whereRaw('DATEDIFF(NOW(), created_at) < 15')
                ->get();



        // $posts = Post::select('*')      
        //         ->when((Carbon::now())->diffInDays(Carbon::parse('created_at')) < 15, function ($query){
        //             return $query->where('legitimacy', '=', '1');
        //         })
        //         ->get();
        //$now = Carbon::now();
        //$timestamp=Carbon::parse($posts->created_at);
        //$diff=(Carbon::now())->diffInDays(Carbon::parse($posts->created_at));
        //return $diff;

        return view('target_actor.views.viewlegit')->with('posts', $posts);
    }
}
