<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Payments;
use App\Models\Permission;
use App\Models\Role;
use App\Models\SigningOffice;
use App\Models\Student;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        SigningOffice::factory()->create([
           'office_name' => 'SBO',
            'signing_sequence' => '4',
        ]);

        Payments::factory()->create([
            'amount' => '268',
            'for' => 'Intramurals',
            'office' => 'CCSO',
            'deadline' => '2021-09-30',
            'payment_type' => 'Contribution',
        ]);

        DB::table('settings')->insert([
            'key' => 'isClearanceOnGoing',
            'value' => false,
        ]);

        $this->call([
            RoleAndPermissionSeeder::class,
            EventSeeder::class,
        ]);
    }
}
