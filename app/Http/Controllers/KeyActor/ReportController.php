<?php

namespace App\Http\Controllers\KeyActor;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function viewReport(Request $request) {
        $posts = Post::where([
            ['id', '!=', Null],
            [function ($query) use ($request){
                if (($s = $request->search))
                {
                    $query->orWhere('description', 'LIKE', '%' . $s . '%')
                    ->orWhere('id', 'LIKE', '%' . $s . '%')
                    ->orWhere('created_at', 'LIKE', '%' . $s . '%')
                    ->orWhere('updated_at', 'LIKE', '%' . $s . '%')
                    ->orWhere('response_status', 'LIKE', '%' . $s . '%')
                    ->orWhere('legitimacy', 'LIKE', '%' . $s . '%')
                    ->orWhere('incident_type', 'LIKE', '%' . $s . '%')
                    ->orWhere('image_path')
                    ->get();
                }
            }]
        ])->paginate(6);

        return view('key_actor.report.viewreport', compact('posts'));
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
        $posts = Post::findorFail($id);
        return view('key_actor.report.edit')->with('posts', $posts);
    }



    // Show Phone number
    public function showPhone()
    {
        $credlist = $phone = User::find()->phone;
        return view('key_actor.report.edit', compact('$credlist'));
    }
    
}
