<?php

namespace App\Http\Controllers\Permissions;

use App\User;
use App\Models\User as ModelUser;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // public function index()
    // {
    //     $users = User::has('roles')->get();
    //     return view('users.index', compact('users'));
    // }

    public function createUser()
    {
        $roles = Role::get();
        return view('users.create', compact('roles'));
    }

    public function storeUser()
    {
        $user = User::where('email', request('email'))->first();
        $user->assignRole(request('roles'));
        return back();
    }

    public function editUser(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::get(),
            'users' => User::has('roles')->get(),
        ]);
    }

    public function updateUser(User $user)
    {
        $user->syncRoles(request('roles'));
        return redirect()->route('users.index');
    }

// =============================//
    public function create()
    {
        $roles = Role::get();
        $users = User::has('roles')->get();
        return view('permission.assign.user.create', compact('roles', 'users'));
    }

    public function store()
    {
        $user = User::where('email', request('email'))->first();
        $user->assignRole(request('roles'));
        return back();
    }

    public function edit(User $user)
    {
        return view('permission.assign.user.edit', [
            'user' => $user,
            'roles' => Role::get(),
            'users' => User::has('roles')->get(),
        ]);
    }

    public function update(User $user)
    {
        $user->syncRoles(request('roles'));
        return redirect()->route('assign.user.create');
    }
}
