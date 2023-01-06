<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name'=> [ 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phonenumber' => ['required', 'digits:9', 'unique:users'],
            'emergency_number1' => ['required', 'digits:9'],
            'emergency_number2' => ['required', 'digits:9'],
            'address' => ['required', 'string', 'max:50'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => strtolower($data['first_name']),
            'last_name'=> strtolower($data['last_name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'email_verified_at' => $data['email_verified_at'],
            'phonenumber' => $data['phonenumber'],
            'address' => strtolower($data['address']),
            'emergency_number1' => $data['emergency_number1'],
            'emergency_number2' => $data['emergency_number2'],
            // 'role_as' => $data['role_as'],
            // 'description' => $data['description'],
            // 'status' => $data['status'],
            // 'created_by' => $data['created_by'],
        ]);
    }
}
