<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $master_admin = Role::create(['name' => 'master_admin']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        $manageUsers = Permission::create(['name' => 'manage_users']);
        $addUser = Permission::create(['name' => 'add_user']);
        $editUser = Permission::create(['name' => 'edit_user']);
        $manageEvents = Permission::create(['name' => 'manage_events']);
        $viewEvents = Permission::create(['name' => 'view_events']);
        $manage_payments = Permission::create(['name' => 'manage_payments']);
        $viewPayments = Permission::create(['name' => 'view_payments']);

        $master_admin->permissions()->attach([$addUser->id, $editUser->id, $manageEvents->id, $viewEvents->id, $manageUsers->id, $manage_payments->id, $viewPayments->id]);
        $admin->permissions()->attach([$manageEvents->id, $viewEvents->id, $manage_payments->id, $viewPayments->id]);
        $user->permissions()->attach([$viewEvents->id, $viewPayments->id]);

        User::find(1)->roles()->attach($admin->id);
        User::find(3)->roles()->attach($master_admin->id);
    }
}
