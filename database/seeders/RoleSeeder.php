<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        $superAdminRole = Role::create(['name' => 'super_admin','display_name'=>'Super Admin']);
        
        Role::create(['name' => 'user','display_name'=>'User']);

        $superAdminRole->givePermissionTo($permissions);
    }
}
