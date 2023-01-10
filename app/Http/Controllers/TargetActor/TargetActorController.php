<?php

namespace App\Http\Controllers\TargetActor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// added
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class TargetActorController extends Controller
{
    public function editUser($id) {
        $user = User::find($id);
        return view('target_actor.users.profile', compact('user'));
    }

    public function update(Request $request, $user_id)
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
        return redirect("/target_actor/profile/".$user_id)->with('message', 'User Updated Succesfully');
    }
    
}

