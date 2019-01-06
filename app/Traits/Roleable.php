<?php

namespace Datakraf\Traits;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

trait Roleable
{
    public function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);        
        // Get the roles
        $roles = Role::find($roles);
    
        // check for current role changes
        if (!$user->hasAllRoles($roles)) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        }

        $user->syncRoles($roles);
        return $user;
    }
}