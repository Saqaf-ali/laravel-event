<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventImage;
use App\Models\Organizer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()
            ->has(
                Organizer::factory()->has(
                    Event::factory()
                        ->count(10)
                        ->has(EventImage::factory()->count(3)),
                ),
            )
            ->create();
    }
}
