<?php

namespace Database\Seeders;

use App\Models\Student;
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
            ->dean()
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

        Student::factory()
            ->psitsAdmin()
            ->create([
                'student_id' => '28640',
                'first_name' => 'Archie',
                'last_name' => 'Lacurom',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->ccsoAdmin()
            ->create([
                'student_id' => '28376',
                'first_name' => 'Mohamad dalil',
                'last_name' => 'Kalipapa',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->sboAdmin()
            ->create([
                'student_id' => '28577',
                'first_name' => 'Albenzar',
                'last_name' => 'Sagad',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->programHead()
            ->create([
                'student_id' => '28246',
                'first_name' => 'Marvin James',
                'last_name' => 'Libag',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->programHead()
            ->create([
                'student_id' => '28568',
                'first_name' => 'James',
                'last_name' => 'Mapiot',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->user()
            ->create([
                'student_id' => '28668',
                'first_name' => 'Katherine',
                'last_name' => 'Macandili',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->user()
            ->create([
                'student_id' => '28438',
                'first_name' => 'Kristine Nicole',
                'last_name' => 'Marcelo',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->user()
            ->create([
                'student_id' => '28312',
                'first_name' => 'Baby Jean',
                'last_name' => 'Guanzon',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->user()
            ->create([
                'student_id' => '28670',
                'first_name' => 'Nick Adrianne',
                'last_name' => 'Jara',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->user()
            ->create([
                'student_id' => '28520',
                'first_name' => 'Jenny',
                'last_name' => 'Borbon',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->user()
            ->create([
                'student_id' => '28521',
                'first_name' => 'Hannah',
                'last_name' => 'Alegrid',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->user()
            ->create([
                'student_id' => '28441',
                'first_name' => 'Nelmar',
                'last_name' => 'Pamplona',
                'course' => 'Computer Science',
            ]);

        Student::factory()
            ->user()
            ->create([
                'student_id' => '28329',
                'first_name' => 'Riemy Joy',
                'last_name' => 'Martinez',
                'course' => 'Computer Science',
            ]);
    }
}
