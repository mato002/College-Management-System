<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::withCount('users', 'permissions')->orderBy('is_system', 'desc')->orderBy('name')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function edit(Role $role): View
    {
        $role->load('permissions');
        $permissions = Permission::orderBy('group')->orderBy('name')->get()->groupBy('group');
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        if ($role->is_system) {
            $request->validate([
                'name' => 'required|string|max:64',
                'description' => 'nullable|string|max:255',
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id',
            ]);
            $role->update($request->only('name', 'description'));
        } else {
            $request->validate([
                'name' => 'required|string|max:64',
                'slug' => 'required|string|max:64|alpha_dash|unique:roles,slug,' . $role->id,
                'description' => 'nullable|string|max:255',
                'type' => 'required|in:admin,lecturer,student',
                'permissions' => 'array',
                'permissions.*' => 'exists:permissions,id',
            ]);
            $role->update($request->only('name', 'slug', 'description', 'type'));
        }

        $role->permissions()->sync($request->input('permissions', []));

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }
}
