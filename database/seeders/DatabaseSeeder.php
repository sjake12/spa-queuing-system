<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'key' => 'isClearanceOnGoing',
            'value' => false,
        ]);

        $this->call([
            RoleAndPermissionSeeder::class,
            SigningOfficeSeeder::class,
            StudentSeeder::class,
            EventSeeder::class,
            PaymentsSeeder::class,
        ]);
    }
}
