<?php

namespace Database\Seeders;

use App\Models\SigningOffice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SigningOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SigningOffice::factory()->create([
            'office_name' => 'Library',
            'signing_sequence' => 1,
        ]);

        SigningOffice::factory()->create([
            'office_name' => 'PSITS',
            'signing_sequence' => 2,
        ]);

        SigningOffice::factory()->create([
            'office_name' => 'CCSO',
            'signing_sequence' => 3,
        ]);

        SigningOffice::factory()->create([
            'office_name' => 'SBO',
            'signing_sequence' => 4,
        ]);

        SigningOffice::factory()->create([
            'office_name' => 'Program Chairman',
            'signing_sequence' => 5,
        ]);

        SigningOffice::factory()->create([
            'office_name' => 'Dean',
            'signing_sequence' => 6,
        ]);
    }
}
