<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UsuariosRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('roles:superadmin');
    }

    public function index()
    {
        $users = User::latest()->paginate(3);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create', [
            'roles' => Role::pluck('display_name', 'id')->take(6),
            'permissions' => Role::latest()->pluck('display_name', 'id')->take(6),
            'user' => new User
        ]);
    }

    public function store(UsuariosRequest $request)
    {
        $user = User::create($request->all());

        $user->roles()->attach($request->roles);

        $user->save();

        return back()->with('status', 'Usuario guardado con éxito!');
    }

    public function show(User $user)
    {
        // $this->authorize('show', $user);

        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        // $this->authorize('update', $user);

        $roles = Role::pluck('display_name', 'id')->take(6);
        $permissions = Role::latest()->pluck('display_name', 'id')->take(6);

        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(ProfileRequest $request, User $user)
    {
        $user->update($request->except(['password']));

        if (! is_null($request->password)) {
            $user->password = $request->password;
            $user->update();
        }

        $user->roles()->sync($request->roles);

        return back()->with('status', 'Usuario actualizado con éxito!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('status', 'Usuario eliminado con éxito!');
    }
}
