<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        Student::factory()->create([
            'student_id' => '28196',
            'first_name' => 'Lee Robin',
            'last_name' => 'Montenegro',
            'course' => 'Computer Science',
        ]);

        Student::factory()->create([
            'student_id' => '28197',
            'first_name' => 'Ralph Vincent',
            'last_name' => 'Rodriguez',
            'course' => 'Computer Science',
        ]);

        Student::factory()->create([
            'student_id' => '28565',
            'first_name' => 'Stephen Jake',
            'last_name' => 'Apostol',
            'course' => 'Computer Science',
        ]);

        $master_admin = Role::create(['name' => 'master_admin']);
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        $manageUsers = Permission::create(['name' => 'manage_users']);
        $addUser = Permission::create(['name' => 'add_user']);
        $editUser = Permission::create(['name' => 'edit_user']);
        $manageEvents = Permission::create(['name' => 'manage_events']);
        $viewEvents = Permission::create(['name' => 'view_events']);

        $master_admin->permissions()->attach([$addUser->id, $editUser->id, $manageEvents->id, $viewEvents->id, $manageUsers->id]);
        $admin->permissions()->attach([$manageEvents->id, $viewEvents->id]);
        $user->permissions()->attach($viewEvents->id);

        User::find(1)->roles()->attach($admin->id);
        User::find(3)->roles()->attach($master_admin->id);
    }
}
