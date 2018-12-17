<?php

namespace Datakraf\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Authorizable;
use Alert;

class RolesController extends Controller
{
    use Authorizable;

    public function __construct(Role $role, Permission $permission, Request $request)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->roleData = ['name' => $request->name];
    }

    /**
     * Roles Index
     *
     * @return void
     */


    /**
     * Store roles
     *
     * @return void
     */
    public function store()
    {
        $this->role->create($this->roleData);
        toast($this->message('save', 'Role'), 'success', 'top-right');
        return redirect()->back();
    }


}
