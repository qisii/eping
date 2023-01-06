<?php

namespace App\Http\Controllers\KeyActor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// added
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KeyActorController extends Controller
{
    public function editUser($user_id)
    {
        $user = User::find($user_id);
        return view('key_actor.users.profile', compact('user'));
    }

    public function update(Request $request, $user_id)
    {
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

        if($request->address !=''){
            User::findOrFail($user_id)->update([
                'address' =>$request->address,
            ]);
        }
        return redirect("/key_actor/profile/".$user_id)->with('message', 'User Updated Succesfully');
        
    }
}
