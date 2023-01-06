<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
// added
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // display all users
    public function index()
    {
        $users = User::sortable();
        $users = User::paginate(11);
        return view('admin.users.index', compact('users'));
    }

    //search
    public function searchUsers(Request $request)
    {
        //$search = User::sortable()->paginate(11);
        if($request->search)
        {
            $search = User::where('id', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('first_name', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('email', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('address', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('role_as', 'LIKE', '%'.$request->search.'%')//
                            ->orWhere('created_at', 'LIKE', '%'.$request->search.'%')
                            ->orWhere('created_by', 'LIKE', '%'.$request->search.'%')//
                            ->orWhere('status', 'LIKE', '%'.$request->search.'%')
                            ->sortable()
                            ->paginate(6);//
                            
            return view('admin.users.search', compact('search'));//index
        }
        else
        {
            return view('admin.users.search');//index
        }
    }

    //filter
    public function filter(Request $request)
    {
        //filter by date and sort by
        //$users = User::sortable()->paginate(11);
        $todayDate = Carbon::now()->format('Y-m-d');
        // // $todayDate = $request->input('todayDate');
        $users = User::when($request->date != null, function ($q) use ($request) {
                        return $q->whereDate('created_at', $request->date);
                    }, function ($q) use ($todayDate){
                        return $q->whereDate('created_at', $todayDate);
                    })
                    ->when($request->role_as != null, function ($q) use ($request) {
                        return $q->where('role_as', $request->role_as);
                    })
                    ->when($request->created_by != null, function ($q) use ($request) {
                        return $q->where('created_by', $request->created_by);
                    })
                    ->when($request->status != null, function ($q) use ($request) {
                        return $q->where('status', $request->status);
                    })
                    ->sortable()
                    ->paginate(5);
                      
        return view('admin.users.filter', compact('users'));
    }

    // view create admin page
    public function createAdmin()
    {
        return view('admin.users.create-admin');
    }

    // view create target actor
    public function createUser()
    {
        return view('admin.users.create-user');
    }
    
    // view create actor
    public function createEka()
    {
        return view('admin.users.create-eka');
    }

    // store target user account
    public function storeUser(Request $request)
    {
    
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'=> [ 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phonenumber' => ['required', 'digits:11', 'unique:users'],
            'emergency_number1' => ['required', 'digits:9'],
            'emergency_number2' => ['required', 'digits:9'],
            'address' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string', 'max:10000'],
        ]);

        User::create([
            'first_name'  => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phonenumber' => $request->phonenumber,
            'emergency_number1' => $request->emergency_number1,
            'emergency_number2' => $request->emergency_number2,
            'address' => $request->address,
            'role_as' => $request->role_as,
            'description'  => $request->description,
            'created_by' => Auth::user()->id,
        ]);

        $users = User::sortable();
        $users = User::paginate(11);
        return redirect("/admin/users")->with('message', 'User Added Successfully');
    }

    // store key actor user account
    public function storeEka(Request $request)
    {
    
        $validated = $request->validate([
            'agency_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phonenumber' => ['required', 'digits:9', 'unique:users'],
        ]);

        User::create([
            'first_name'  => $request->agency_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phonenumber' => $request->phonenumber,
            'address' => $request->address,
            'role_as' => $request->role_as,
            'description'  => $request->description,
            'created_by' => Auth::user()->id,
        ]);
        
        $users = User::sortable();
        $users = User::paginate(11);
        return redirect("/admin/users")->with('message', 'User Added Successfully');
    }

    // store key admin user account
    public function storeAdmin(Request $request)
    {
    
        $validated = $request->validate([
            'user_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'first_name'  => $request->user_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_as' => $request->role_as,
            'created_by' => Auth::user()->id,
        ]);

        $users = User::sortable();
        $users = User::paginate(11);
        return redirect("/admin/users")->with('message', 'User Added Successfully');
    }

    // update key actor account
    public function updateEka(Request $request, $user_id)
    {
        if($request->address !=''){
            User::findOrFail($user_id)->update([
                'address' =>$request->address,
            ]);
        } 

        if($request->password !=''){
            $validated = $request->validate([
            'password' => [ 'string', 'min:8', 'confirmed']
            ]);
            User::findOrFail($user_id)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if($request->agency_name !=''){
            $validated = $request->validate([
                'agency_name' => ['required', 'string', 'max:50'],
            ]);
            User::findOrFail($user_id)->update([
                'first_name'  => $request->agency_name,
            ]);
        }

        if($request->email !=''){
            $validated = $request->validate([
                'email' => [ 'string', 'email', 'max:255', 'unique:users'],
            ]);
            User::findOrFail($user_id)->update([
                'email' => $request->email,
            ]);
        }

        if($request->phonenumber !=''){
            $validated = $request->validate([
                'phonenumber' => [ 'digits:9', 'unique:users'],
            ]);
            User::findOrFail($user_id)->update([
                'phonenumber' => $request->phonenumber,
            ]);
        }

        if($request->description !=''){
            $validated = $request->validate([
                'description' => ['string', 'max:1000'],
            ]);
            User::findOrFail($user_id)->update([
                'description'  => $request->description,
            ]);
        }
        return redirect("/admin/profile/".$user_id)->with('message', 'User Updated Succesfully');
        
    }

    // update admin account
    public function updateAdmin(Request $request, $user_id)
    {
        if($request->password !=''){
            $validated = $request->validate([
            'password' => [ 'string', 'min:8', 'confirmed']
            ]);
            User::findOrFail($user_id)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if($request->user_name !=''){
            $validated = $request->validate([
                'user_name' => ['required', 'string', 'max:50'],
            ]);
            User::findOrFail($user_id)->update([
                'first_name'  => $request->user_name,
            ]);
        }

        if($request->email !=''){
            $validated = $request->validate([
                'email' => [ 'string', 'email', 'max:255', 'unique:users'],
            ]);
            User::findOrFail($user_id)->update([
                'email' => $request->email,
            ]);
        }
        return redirect("/admin/profile/".$user_id)->with('message', 'User Updated Succesfully');
    }

    // update target actor account
    public function updateUser(Request $request, $user_id)
    {

        if($request->address !=''){
            User::findOrFail($user_id)->update([
                'address' =>$request->address,
            ]);
        }
        
        if($request->password !=''){
            $validated = $request->validate([
            'password' => [ 'string', 'min:8', 'confirmed']
            ]);
            User::findOrFail($user_id)->update([
                'password' => Hash::make($request->password),
            ]);
        }

        if($request->first_name !=''){
            $validated = $request->validate([
                'first_name' => ['required', 'string', 'max:50'],
            ]);
            User::findOrFail($user_id)->update([
                'first_name'  => $request->first_name,
            ]);
        }

        if($request->last_name !=''){
            $validated = $request->validate([
                'last_name'=> ['string', 'max:50'],
            ]);
            User::findOrFail($user_id)->update([
                'last_name'  => $request->last_name,
            ]);
        }

        if($request->email !=''){
            $validated = $request->validate([
                'email' => [ 'string', 'email', 'max:255', 'unique:users'],
            ]);
            User::findOrFail($user_id)->update([
                'email' => $request->email,
            ]);
        }

        if($request->phonenumber !=''){
            $validated = $request->validate([
                'phonenumber' => [ 'digits:9', 'unique:users'],
            ]);
            User::findOrFail($user_id)->update([
                'phonenumber' => $request->phonenumber,
            ]);
        }

        if($request->description !=''){
            $validated = $request->validate([
                'description' => ['string', 'max:1000'],
            ]);
            User::findOrFail($user_id)->update([
                'description'  => $request->description,
            ]);
        }

        if($request->emergency_number1 !=''){
            $validated = $request->validate([
                'emergency_number1' => [ 'digits:9', 'unique:users'],
            ]);
            User::findOrFail($user_id)->update([
                'emergency_number1' => $request->emergency_number1,
            ]);
        }

        if($request->emergency_number2 !=''){
            $validated = $request->validate([
                'emergency_number2' => [ 'digits:9', 'unique:users'],
            ]);
            User::findOrFail($user_id)->update([
                'emergency_number2' => $request->emergency_number2,
            ]);
        }
        return redirect("/admin/profile/".$user_id)->with('message', 'User Updated Succesfully');
    }

    // view account
    public function editUser($user_id)
    {
        $user = User::find($user_id);
        return view('admin.users.edit', compact('user'));
    }

    
    // delete user
    public function deleteUser(int $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        // return view('admin.users.index')->with('message', 'User Deleted Successfully');
        return redirect("/admin/users")->with('message', 'User Deleted Successfully');
    }
    
}
