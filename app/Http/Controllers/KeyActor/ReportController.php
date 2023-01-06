<?php

namespace App\Http\Controllers\KeyActor;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function viewReport() {
        $posts = Post::all();
        return view('key_actor.report.viewreport', compact('posts'));
    }
    public function updateResponse(Request $request, $id)
    {
        $posts = Post::findOrFail($id);
        if ($request->description or $request->response_status != ''){

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
           
            
            return redirect("/key_actor/report/edit-report/".$id)->with('message', 'Report Updated Succesfully');
        } else {
            return redirect("/key_actor/report/edit-report/".$id);
        }
    }
    public function editReport($id)
    {
        $posts = Post::findorFail($id);
        return view('key_actor.report.edit')->with('posts', $posts);
    }
}
