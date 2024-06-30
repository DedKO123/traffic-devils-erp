<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        Role::create(['name' => 'buyer']);
        $teamLead = Role::create(['name' => 'team_lead']);

        Permission::create(['name' => 'manage user']);
        Permission::create(['name' => 'view statistics']);
        Permission::create(['name' => 'view all statistics']);

        $admin->givePermissionTo(['manage user', 'view statistics', 'view all statistics']);
        $teamLead->givePermissionTo(['view statistics']);
        Role::query()->where('name', 'admin')->first()->givePermissionTo(['view all statistics']);
    }
}
