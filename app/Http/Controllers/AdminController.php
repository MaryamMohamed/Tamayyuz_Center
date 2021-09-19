<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Hash;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administrator']);
    }

    public function dashboard()
    {
        # code...
        return view('admin.dashboard');
    }

    public function userIndex()
    {
        # code...
        $users = User::orderBy('id', 'desc')->with('roles')->paginate(10);
        return view('admin.manage.user.index', compact('users'));
    }

    public function userCreate()
    {
        # code...
        $roles = Role::all();
        return view('admin.manage.user.create', compact('roles'));
    }

    public function userStore(Request $request)
    {
        # code...
        $role = Role::where('name', $request->rolesSelected)->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->assignRole($role);

        return redirect()->route('userIndex');
    }

    public function userEdit($id)
    {
        # code...
        $user = User::find($id);
        $roles = Role::all();
        return view('admin.manage.user.edit', compact('user', 'roles'));
    }

    public function userUpdate(Request $request, $id)
    {
        # code...
        $role = Role::where('name', $request->rolesSelected)->first();

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();
        $user->updateRole($role);

        return redirect()->route('userIndex');
    }

    public function userDelete($id)
    {
        # code...
        User::find($id)->delete();

        return redirect()->route('userIndex');
    }
}
