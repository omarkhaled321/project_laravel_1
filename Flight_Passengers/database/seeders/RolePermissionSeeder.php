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
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $user = Role::firstOrCreate(['name' => 'user']);

        $viewFlights = Permission::firstOrCreate(['name' => 'view flights']);
        $manageUsers = Permission::firstOrCreate(['name' => 'manage users']);

        $admin->givePermissionTo([$viewFlights, $manageUsers]);
        $user->givePermissionTo($viewFlights);

        $adminUser = User::find($id); 
        if ($adminUser) {
            $adminUser->assignRole($admin);
        }
    }
}
