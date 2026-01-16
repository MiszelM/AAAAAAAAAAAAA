<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
    
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Lista uprawnień
        $permissions = [
            'users.view',
            'users.edit',
            'users.delete',
            'users.assign_role',

            'employees.view',
            'employees.manage',

            'clients.view',
            'clients.manage',

            'credit_offers.view',
            'credit_offers.manage',

            'applications.create',
            
        ];

        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $management = Role::firstOrCreate(['name' => 'management']);
        $employee = Role::firstOrCreate(['name' => 'employee']);
        $client = Role::firstOrCreate(['name' => 'client']);


        $admin->givePermissionTo(Permission::all());

        $management->givePermissionTo([
            'employees.view',
            'employees.manage',
            'clients.view',
        ]);

        $employee->givePermissionTo([
            'clients.manage',
            'credit_offers.view',
            'credit_offers.manage',
            
        ]);

        $client->givePermissionTo([
            'applications.create',
        ]);
    }
}