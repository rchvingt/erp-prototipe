<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Spatie\Permission\Models\Role;

class RolePermisionController extends Controller
{
    public function index(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['role.view']);

        return view('pages.akses-role.index', [
            'roles' => Role::all(),
        ]);
    }
}
