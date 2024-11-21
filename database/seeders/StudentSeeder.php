<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\SigningOffice;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::factory()
            ->libraryAdmin()
            ->create([
                'student_id' => '28196',
                'first_name' => 'Lee Robin',
                'last_name' => 'Montenegro',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->user()
            ->create([
                'student_id' => '28197',
                'first_name' => 'Ralph Vincent',
                'last_name' => 'Rodriguez',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->masterAdmin()
            ->create([
                'student_id' => '28565',
                'first_name' => 'Stephen Jake',
                'last_name' => 'Apostol',
                'course' => 'Computer Science',
            ]);
    }
}
