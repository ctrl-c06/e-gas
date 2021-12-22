<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('administrator.index', compact('users'));
    }
    
    public function create()
    {
        return view('administrator.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|unique:users',
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'password' => 'required|confirmed',
        ]);

        User::create([
            'username' => $request->username,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'You successfully create a new administrator');
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        return view('administrator.edit', compact('user'));
    }

    public function update(Request $request, int $id)
    {
        $this->validate($request, [
            'username' => 'required|unique:users,username,' . $id,
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'password' => 'nullable|confirmed',
        ]);

        $user = User::find($id);
        $user->username = $request->username;
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->password = is_null($request->password) ? $user->password : bcrypt($request->password);
        $user->save();

        return back()->with('success', 'You successfully update the administrator information');
    }

}
