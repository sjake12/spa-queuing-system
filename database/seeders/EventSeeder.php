<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory()->create([
            'event_name' => '3rd General Assembly Meeting',
            'event_date' => '2024-01-19',
            'signing_office' => 4,
            'required' => true,
            'created_by' => '28196',
        ]);

        Event::factory()->create([
            'event_name' => '3rd General Assembly Meeting',
            'event_date' => '2024-02-23',
            'signing_office' => 3,
            'required' => true,
            'created_by' => '28196',
        ]);

        Event::factory()->create([
            'event_name' => 'Post Valentines Escapade',
            'event_date' => '2021-03-08',
            'signing_office' => 4,
            'required' => true,
            'created_by' => '28196',
        ]);

        Event::factory()->create([
            'event_name' => '2nd General Assembly Meeting',
            'event_date' => '2021-03-30',
            'signing_office' => 2,
            'required' => true,
            'created_by' => '28196',
        ]);
    }
}
