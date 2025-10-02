<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventImage;
use App\Models\Organizer;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizer = Organizer::first();
        Event::factory(7)
            ->for($organizer)
            ->has(EventImage::factory()->count(3))
            ->has(Ticket::factory()->count(3))
            ->create();
    }
}
