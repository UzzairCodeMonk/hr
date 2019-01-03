<?php

namespace Datakraf\Http\Controllers;

use Datakraf\Role;
use Datakraf\Permission;
use Illuminate\Http\Request;
use Datakraf\Authorizable;
use Alert;

class RolesController extends Controller
{
    use Authorizable;

    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::orderBy('name')->get();

        return view('backend.roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|unique:roles']);

        if (Role::create($request->only('name'))) {
            toast('The role has been added', 'success', 'top-right');
        }

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        if ($role = Role::findOrFail($id)) {
            // admin role has everything
            if ($role->name === 'Admin') {
                $role->syncPermissions(Permission::all());
                toast($role->name . ' permissions updated', 'success', 'top-right');
                return redirect()->route('roles.index');
            }

            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
            toast($role->name . ' permissions updated', 'success', 'top-right');
        } else {
            toast($role->name . ' not found', 'error', 'top-right');
        }

        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {

        Role::find($id)->delete();
        toast(' The roles has been deleted ', 'success', 'top-right');
        return redirect()->back();
    }

}
