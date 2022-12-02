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
        return view('key_actor.users.edit', compact('user'));
    }
}
