<?php


namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //1- create permissions

        // Permissions for managing menus
        Permission::create(['name' => 'create menu']);
        Permission::create(['name' => 'edit menu']);
        Permission::create(['name' => 'delete menu']);

        // Permissions for managing subscriptions
        Permission::create(['name' => 'manage subscriptions']); // For admin
        Permission::create(['name' => 'manage users']); // For admin
        Permission::create(['name' => 'select subscription plan']); // For restaurant owners

        // Permissions for managing users and operators
        Permission::create(['name' => 'manage operators']); // Feor restaurant owners

        // Permissions for managing restaurant information
        Permission::create(['name' => 'manage restaurant information']); // For restaurant owners



        //2- assign relevant permissions & create roles

        // Create admin role and assign all permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->syncPermissions(Permission::all());



        // Create restaurant owner role and assign relevant permissions
        $restaurantOwnerRole = Role::create(['name' => 'restaurant owner']);
        $restaurantOwnerRole->syncPermissions([
            'create menu',
            'edit menu',
            'delete menu',
            'select subscription plan',
            'manage restaurant information',
            'manage operators'
        ]);

        // Create operator role and assign permissions for managing menus
        $operatorRole = Role::create(['name' => 'operator']);
        // $operatorRole->syncPermissions([
        //     'create menu',
        //     'edit menu',
        //     'delete menu'
        // ]);
    }
}
