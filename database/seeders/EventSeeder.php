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
            'event_date' => '2021-09-30',
            'signing_office' => 1,
            'required' => true,
            'created_by' => '28196',
        ]);

        Event::factory()->create([
            'event_name' => 'Post Valentines Escapade',
            'event_date' => '2021-09-30',
            'signing_office' => 1,
            'required' => true,
            'created_by' => '28196',
        ]);

        Event::factory()->create([
            'event_name' => '2nd General Assembly Meeting',
            'event_date' => '2021-09-30',
            'signing_office' => 1,
            'required' => true,
            'created_by' => '28196',
        ]);
    }
}
