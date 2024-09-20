<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
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
}
