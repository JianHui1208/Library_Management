<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\UpdateUsersProfileRequest;
use App\Http\Requests\UpdateUsersPasswordRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function getProfile()
    {
        $user = Auth::user();

        return view('users.profile.index', compact('user'));
    }

    // 未完成
    // 检查每个国家不同length的电话号码
    public function updateProfile(UpdateUsersProfileRequest $request)
    {
        $user = auth()->user();

        $phone = $request->input('phone_number');
        $firstDigit = substr($phone, 0, 1);

        if($firstDigit == "1"){
            $phone_number = "+60".$request->input('phone_number');
        }

        if($firstDigit == "0"){
            $phone_number = "+6".$request->input('phone_number');
        }

        $request['phone_number'] = $phone_number;

        $user->update($request->all());

        return redirect()->route('users.profile')->with('message', __('global.update_profile_success'));
    }

    public function changePassword(UpdateUsersPasswordRequest $request)
    {
        User::where('id', Auth::id())->update(['password' => $request->input('password')]);

        return redirect()->route('users.profile')->with('message', __('global.change_password_success'));
    }
}
