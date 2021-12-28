<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('administrator.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        
        $this->validate($request, [
            'username' => 'required|unique:users,username,' . $user->id,
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'password' => 'nullable',
            'new_password' => ['nullable', 'same:confirm_password'],
        ]);

        if(Hash::check($request->password, $user->password)) {
            $user->username = $request->username;
            $user->firstname = $request->firstname;
            $user->middlename = $request->middlename;
            $user->lastname = $request->lastname;
            $user->password = bcrypt($request->new_password);
            $user->save();
            return back()->with('success', 'Successfully update');
        } else {
            return back()->withErrors(['password' => 'You\'ve entered incorrect password.']);
        }
        
    }
}
