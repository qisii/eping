<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// added
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    // create
    public function createAdmin()
    {
        return view('admin.users.create-admin');
    }
    
    public function createEka()
    {
        return view('admin.users.create-eka');
    }

    // store
    public function storeUser(Request $request)
    {
    
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'first_name'  => $request->first_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phonenumber' => $request->phonenumber,
            'address' => $request->address,
            'role_as' => $request->role_as,
            'description'  => $request->description,
            'created_by' => Auth::user()->id,


        ]);
        $users = User::all();
        return view('admin.users.index', compact('users'))->with('message', 'Category Added Succesfully ');
    }

    public function editUser($user_id)
    {
        $user = User::find($user_id);
        return view('admin.users.edit', compact('user'));
    }
    
    
}
