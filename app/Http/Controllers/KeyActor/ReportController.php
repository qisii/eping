<?php

namespace App\Http\Controllers\KeyActor;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Schema\Grammars\PostgresGrammar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ReportController extends Controller
{

    public function viewReport(Request $request) {
        $posts = Post::sortable();
        $posts = Post::paginate(11);
        return view('key_actor.report.viewreport', compact('posts'));
    }

    public function searchReport(Request $request) {
        if($request->search)
        {
            $search = Post::where('id', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('incident_type', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('description', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('response_status', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('legitimacy', 'LIKE', '%'.$request->search.'%')//
                            ->orWhere('created_at', 'LIKE', '%'.$request->search.'%')
                            // ->orWhere('img_path', 'LIKE', '%'.$request->search.'%')//
                            ->orWhere('updated_at', 'LIKE', '%'.$request->search.'%')
                            ->sortable()
                            ->paginate(6);
                            
            return view('key_actor.report.search-report', compact('search'));
        }
        else
        {
            return view('key_actor.report.search-report');//index
        }
        // $posts = Post::where([
        //     ['id', '!=', Null],
        //     [function ($query) use ($request){
        //         if (($s = $request->search))
        //         {
        //             $query->orWhere('description', 'LIKE', '%' . $s . '%')
        //             ->orWhere('id', 'LIKE', '%' . $s . '%')
        //             ->orWhere('created_at', 'LIKE', '%' . $s . '%')
        //             ->orWhere('updated_at', 'LIKE', '%' . $s . '%')
        //             ->orWhere('response_status', 'LIKE', '%' . $s . '%')
        //             ->orWhere('legitimacy', 'LIKE', '%' . $s . '%')
        //             ->orWhere('incident_type', 'LIKE', '%' . $s . '%')
        //             ->orWhere('image_path')
        //             ->get();
        //         }
        //     }]
        // ])->paginate(6);

        // return view('key_actor.report.viewreport', compact('posts'));
    }
    public function filterReport(Request $request)
    {
        //$createdDate = Carbon::now()->format('Y-m-d');
        // $expiryDate = Carbon::now()->format('Y-m-d');
        $reportDate = $request->input('reportDate');
        //$expiryDate = $request->input('expiryDate');

        if($request->reportDate != null && $request->legitimacy != null && $request->response_status != null){
            $posts = Post::whereDate('created_at', $request->reportDate)->where('legitimacy', $request->legitimacy)->where('response_status', $request->response_status)
            ->sortable()
            ->paginate(5);
        }
        elseif($request->reportDate != null){
            $posts = Post::whereDate('created_at', $request->reportDate)
            ->sortable()
            ->paginate(5);
        }
        elseif($request->legitimacy != null){
            $posts = Post::where('legitimacy', $request->legitimacy)
            ->sortable()
            ->paginate(5);
        }
        elseif($request->response_status != null){
            $posts = Post::where('response_status', $request->response_status)
            ->sortable()
            ->paginate(5);
        }

        else{
            $posts = Post::sortable()->paginate(5);
        }

        return view('key_actor.report.filter-report', compact('posts', 'reportDate'));
    }

    public function updateReport(Request $request, $id)
    {
        $posts = Post::findOrFail($id);
        if ($request->description or $request->response_status or $request->legitimacy != ''){

            if($request->response_status !=''){
                Post::findOrFail($id)->update([
                    "response_status" => $request->response_status,
                ]);
            }
            if($request->description !=''){
                Post::findOrFail($id)->update([
                    "description" => $request->description,
                ]);
            }
            if($request->legitimacy !=''){
                Post::findOrFail($id)->update([
                    "legitimacy" => $request->legitimacy,
                ]);
            }
           
            
            return redirect("/key_actor/report/viewreport/")->with('message', 'Report Updated Succesfully');
        } else {
            return redirect("/key_actor/report/edit-report/".$id);
        }
    }
    public function editReport($id)
    {
        $posts = User::join('posts', 'posts.user_id', '=', 'users.id')->where('posts.id', '=' , $id)->first();

        return view('key_actor.report.edit')->with('posts', $posts);
    }
   
}
