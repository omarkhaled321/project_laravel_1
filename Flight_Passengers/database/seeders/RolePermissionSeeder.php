<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles if they don't already exist
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        // Create permissions if they don't already exist
        $viewFlights = Permission::firstOrCreate(['name' => 'view flights']);
        $manageUsers = Permission::firstOrCreate(['name' => 'manage users']);

        // Assign permissions to roles
        $admin->givePermissionTo([$viewFlights, $manageUsers]);
        $user->givePermissionTo($viewFlights);

        // Assign the 'admin' role to the first user (or any specific user)
        $adminUser = User::find($id); // Replace with the actual user ID or a different user
        if ($adminUser) {
            $adminUser->assignRole($admin);
        }
    }
}
