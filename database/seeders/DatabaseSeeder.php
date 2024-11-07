<?php

namespace Database\Seeders;

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

        User::create([
            'username' => '28196',
            'password' => Hash::make('1234'),
        ]);

        Student::factory()->create([
            'student_id' => '28197',
            'first_name' => 'Ralph Vincent',
            'last_name' => 'Rodriguez',
            'course' => 'Computer Science',
        ]);

        User::create([
            'username' => '28197',
            'password' => Hash::make('1234'),
        ]);
    }
}
