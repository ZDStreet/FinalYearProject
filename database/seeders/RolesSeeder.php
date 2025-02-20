<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // create the roles
        $adminRole = Role::create(['name' => 'admin']);
        $chairRole = Role::create(['name' => 'chair']);
        $reviewerRole = Role::create(['name' => 'reviewer']);
        $authorRole = Role::create(['name' => 'author']);

        // create permissions
        $uploadAbstract = Permission::create(['name' => 'upload Abstract']);
        $deleteAbstract = Permission::create(['name' => 'delete Abstract']);
        
        // Assign permissions to roles
        $adminRole->givePermissionTo([
            $uploadAbstract,
            $deleteAbstract,
        ]);

        $chairRole->givePermissionTo([
            $uploadAbstract,
            $deleteAbstract,
        ]);

        $reviewerRole->givePermissionTo([
            $uploadAbstract,
            $deleteAbstract,
        ]);

        $authorRole->givePermissionTo([
            $uploadAbstract,
            $deleteAbstract,
        ]);
        
    }
}
