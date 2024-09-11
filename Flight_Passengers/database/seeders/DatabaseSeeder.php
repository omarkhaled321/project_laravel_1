<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        $permissions = [
            'view users',
            'edit users',
            'delete users',
            'create posts',
            'edit posts',
            'delete posts',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        
        $adminRole->givePermissionTo(Permission::all());
        $editorRole->givePermissionTo([
            'create posts',
            'edit posts',
            'delete posts',
        ]);
        $user1 = User::create([
            'name' => 'Omar',
            'email' => 'Omar.Khaled@gmail.com',
            'password' => bcrypt('password'),
        ]);
        $user2 = User::create([
            'name' => 'Omarr',
            'email' => 'Omar.Khaled22@gmail.com',
            'password' => bcrypt('passwordd'),
        ]);
        $user1->assignRole('admin'); 
        $user2->assignRole('editor'); 
    }
}
