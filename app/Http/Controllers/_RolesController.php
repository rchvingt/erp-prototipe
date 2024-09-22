<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(): Renderable
    {
        return view('pages.roles.rolesIndex', [
            'roles' => Role::with('users')->get(), // Mengambil role beserta users,
            'menuActiveRole' => 'active',
            'menuActiveParent' => 'active open',
            // Mengambil permissions berdasarkan group_name
            'permissions' => Permission::all()->groupBy('group_name'),
        ]);
    }

    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->role_name]);
        $role->permissions()->sync($request->permissions);  // Save selected permissions

        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }
}
