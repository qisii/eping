<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;;
// added
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ReportController extends Controller
{
    public function ticketreports(){

        // $posts = Post::join('users', 'posts.user_id', '=', 'users.id')->where('legitimacy', '=', '2')->get();
        $posts = Post::sortable();
        $posts = Post::paginate(5);
        return view('admin.reports.viewticket')->with('posts', $posts);
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
                            ->paginate(5);
                            
            return view('admin.reports.search-report', compact('search'));
        }
        else
        {
            return view('admin.reports.search-report');//index
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
        elseif($request->reportDate != null && $request->legitimacy != null){
            $posts = Post::whereDate('created_at', $request->reportDate)->where('legitimacy', $request->legitimacy)
            ->sortable()
            ->paginate(5);
        }
        elseif($request->reportDate != null && $request->response_status != null){
            $posts = Post::whereDate('created_at', $request->reportDate)->where('response_status', $request->response_status)
            ->sortable()
            ->paginate(5);
        }
        elseif($request->legitimacy != null && $request->response_status != null){
            $posts = Post::where('legitimacy', $request->legitimacy)->where('response_status', $request->response_status)
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

        return view('admin.reports.filter-report', compact('posts', 'reportDate'));
    }
}
