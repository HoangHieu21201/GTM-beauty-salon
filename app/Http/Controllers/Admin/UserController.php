<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            \App\Http\Middleware\CheckSuperAdmin::class,
        ];
    }

    public function index()
    {
        $users = User::with('role')->latest()->get();
        $roles = Role::all();
        return view('admin.pages.users.index', compact('users', 'roles'));
    }

    public function store(\App\Http\Requests\Admin\StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Đã tạo người dùng mới!');
    }

    public function update(\App\Http\Requests\Admin\UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Đã cập nhật thông tin người dùng!');
    }

    public function destroy(string $id)
    {
        if (auth()->id() == $id) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể tự xóa tài khoản của chính mình!');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Đã xóa người dùng!');
    }
}
