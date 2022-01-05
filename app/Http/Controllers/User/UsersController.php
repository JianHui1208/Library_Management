<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();

        return view('users.profile.index', compact('user'));
    }
}
