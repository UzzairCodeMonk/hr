<?php

use Illuminate\Database\Seeder;
use Datakraf\Role;
use Datakraf\Permission;
class RolesAndPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');
       
        // create permissions
        Permission::firstOrCreate(['name' => 'approve_leave', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'approve_claim', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'view_leave', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'view_claim', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'reject_leave', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'reject_claim', 'guard_name' => 'web']);

        // create roles and assign created permissions
        $role = Role::firstOrCreate(['name' => 'Approver','guard_name'=>'web']);
        $role->givePermissionTo('approve_leave');
        $role->givePermissionTo('approve_claim');
        $role->givePermissionTo('view_leave');
        $role->givePermissionTo('view_claim');
        $role->givePermissionTo('reject_leave');
        $role->givePermissionTo('reject_claim');
    }
}
