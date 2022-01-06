<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $phone = $data['phone_number'];
        $firstDigit = substr($phone, 0, 1);

        if($firstDigit == "1"){
            $phone_number = "+60".$data['phone_number'];
        }

        if($firstDigit == "0"){
            $phone_number = "+6".$data['phone_number'];
        }

        $data['phone_number'] = $phone_number;

        return Validator::make($data, [
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username'          => ['required', 'string', 'max:255', 'unique:users'],
            'phone_number'      => ['required', 'string', 'max:255', 'unique:users'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        $phone = $data['phone_number'];
        $firstDigit = substr($phone, 0, 1);

        if($firstDigit == "1"){
            $phone_number = "+60".$data['phone_number'];
        }

        if($firstDigit == "0"){
            $phone_number = "+6".$data['phone_number'];
        }

        $data['phone_number'] = $phone_number;
        $data['type'] = 2;

        return User::create($data);
    }
}
