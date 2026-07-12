<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            \App\Http\Middleware\CheckSuperAdmin::class,
        ];
    }

    public function store(\App\Http\Requests\Admin\StoreRoleRequest $request)
    {
        $validated = $request->validated();

        $role = Role::create([
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'role' => $role
        ]);
    }
}
