<?php

namespace Database\Seeders;

use App\Models\Payments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Payments::factory()->create([
            'amount' => '268',
            'for' => 'Intramurals',
            'office_id' => 3,
            'deadline' => '2024-10-30',
            'payment_type' => 'Contribution',
        ]);

        Payments::factory()->create([
            'amount' => '42',
            'for' => 'Acquaintance Party',
            'office_id' => 4,
            'deadline' => '2024-09-30',
            'payment_type' => 'Contribution',
        ]);

        Payments::factory()->create([
            'amount' => '23',
            'for' => 'Teachers Day',
            'office_id' => 4,
            'deadline' => '2024-09-30',
            'payment_type' => 'Contribution',
        ]);

        Payments::factory()->create([
            'amount' => '35',
            'for' => 'Intramural (Fun run)',
            'office_id' => 4,
            'deadline' => '2024-11-15',
            'payment_type' => 'Contribution',
        ]);

        Payments::factory()->create([
            'amount' => '10',
            'for' => 'Intramural (Props)',
            'office_id' => 3,
            'deadline' => '2024-10-30',
            'payment_type' => 'Contribution',
        ]);
    }
}
