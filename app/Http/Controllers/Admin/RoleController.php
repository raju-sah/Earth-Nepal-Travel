<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index() : View
    {
        $this->authorize('access-role-page');

        return view('admin.role.index', [
            'roles' => Role::query()->select(['id', 'title','slug'])->latest()->get()
        ]);
    }

    public function create() : View
    {
        $this->authorize('add-role');

        return view('admin.role.create',[
            'permissions' => Permission::select(['id', 'title'])->get()
        ]);
    }

    public function store(RoleRequest $request) : RedirectResponse
    {
        $role = Role::create($request->safe()->except('permissions'));

        $role->permissions()->sync($request->permissions, []);

        return redirect()->route('admin.roles.index')->with('success', 'Role Created Successfully!');
    }

    public function show(Role $role) : View
    {
        $this->authorize('access-role-page');

        return view('admin.role.show', compact('role'));
    }

    public function edit(Role $role) : View
    {
        $this->authorize('edit-role');

        $role->load('permissions:id,title');
        return view('admin.role.edit',[
            'role' => $role,
            'permissions' => Permission::select(['id', 'title'])->get(),
        ]);
    }

    public function update(RoleUpdateRequest $request, Role $role) : RedirectResponse
    {
        $role->update($request->safe()->except('permissions'));

        $role->permissions()->sync($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Role Updated Successfully!');
    }

    public function destroy(Role $role) : RedirectResponse
    {
        $this->authorize('delete-role');

        $role->delete();

        return redirect()->route('admin.roles.index')->with('error', 'Role Deleted Successfully!');
    }
}
