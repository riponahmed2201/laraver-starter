<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.profile.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,' . Auth::user()->id,
            'avatar' => 'nullable|image'
        ]);

        //Get logged in user.
        $user = Auth::user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        //Upload image
        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }

        notify()->success('Profile updated successfull.', 'Success');

        return back();
    }

    public function changePassword()
    {
        return view('backend.profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::user();

        $hashedPassword = $user->password;

        if (Hash::check($request->current_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
                Auth::logout();
                notify()->success('Password was changed successfully.', 'Success');
                return to_route('login');
            } else {
                notify()->warning('New password can not be same as old password.', 'Warning');
            }
        } else {
            notify()->error('Current password not match.', 'Error');
        }

        return back();
    }
}
