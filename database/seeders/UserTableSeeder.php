<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run(): void
    {
        // $admin = User::create([
        //         'name'  => 'Admin',
        //         'email' => 'admin@gmail.com',
        //         'password'  => bcrypt('password'),
        //         'role'  => 'admin'
        // ]);

        // $admin->assignRole('admin');

        // $user = User::create([
        //         'name'  => 'Anggota',
        //         'email' => 'anggota@gmail.com',
        //         'password'  => bcrypt('password'),
        //         'role'  => 'anggota'
        // ]);

        // $user->assignRole('anggota');

        $role = Role::find(1);
        $permissions = permission::all();

        $role->syncPermissions($permissions);

        $user = User::find(1);
        $user->assignRole($role->name);
    }
}
