<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.roles.rolesCreate', [
            'menuActiveRole' => 'active',
            'menuActiveParent' => 'active open',
            // Mengambil permissions berdasarkan group_name
            'permissions' => Permission::all()->groupBy('group_name'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $role = Role::create(['name' => $request->name]);
            $role->permissions()->sync($request->permissions);  // Save selected permissions

            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with([
                'failed' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // Ambil semua permissions
        // $permissions = Permission::all();
        $permissions = Permission::all()->groupBy('group_name');
        // dd($permissions);

        // Ambil permission yang terhubung dengan role ini
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        // dd($rolePermissions);

        return view('pages.roles.rolesEdit', [
            'role' => $role,
            'menuActiveRole' => 'active',
            'menuActiveParent' => 'active open',
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // \Log::info($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
        ]);

        // Update nama role
        $role->name = $request->name;
        $role->save();

        // Sync permissions
        $role->permissions()->sync($request->permissions);
        // Debugging: Cek apakah update berhasil
        // dd($role->name, $role->permissions()->pluck('id'));

        // Redirect dengan pesan sukses
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
