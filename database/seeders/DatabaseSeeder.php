<?php

namespace Database\Seeders;

use App\Models\Payments;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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



        DB::table('settings')->insert([
            'key' => 'isClearanceOnGoing',
            'value' => false,
        ]);

        $this->call([
            RoleAndPermissionSeeder::class,
            SigningOfficeSeeder::class,
            EventSeeder::class,
            PaymentsSeeder::class,
        ]);
    }
}
