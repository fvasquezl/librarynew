<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Department;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Providers\Events\UserWasCreated;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\User\UpdateRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::get();

        return view('admin.users.index', compact('users'));
    }


    /**
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function create()
    {
        $user = new User;

        $this->authorize('create', $user);

        $departments = Department::get();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');
        return view(
            'admin.users.create',
            compact('user', 'roles', 'permissions', 'departments')
        );
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', new User);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        $data['password'] = Str::random(8);

        $user = User::create($data);

        if ($request->filled('roles')) {
            $user->assignRole($request->roles);
        }

        if ($request->filled('permissions')) {
            $user->givePermissionTo($request->permissions);
        }

        if ($request->filled('departments')) {
            $user->departments()->attach($request->departments);
        }

        UserWasCreated::dispatch($user, $data['password']);

        return redirect()
            ->route('admin.users.index')
            ->with('info', 'El Usuario ha sido creado con exito');
    }


    /**
     * @param User $user
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);

        return view('admin.users.show', compact('user'));
    }


    /**
     * @param User $user
     * @return Application|Factory|View
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $departments = Department::get();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::pluck('name', 'id');
        return view(
            'admin.users.edit',
            compact('user', 'roles', 'permissions', 'departments')
        );
    }


    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $request->updateUser($user);

        return redirect()->route('admin.users.edit', $user)
            ->with('info', 'Usuario actualizado con exito');
    }


    /**
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->departments()->detach();

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('info', 'Usuario Eliminado con exito');
    }
}
