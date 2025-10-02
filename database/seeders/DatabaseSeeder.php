<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventImage;
use App\Models\Organizer;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::disk('public')->deleteDirectory('event_images');
        Storage::disk('public')->makeDirectory('event_images');
        $this->call([UserSeeder::class, OrganizerSeeder::class, EventSeeder::class, OrderSeeder::class]);
    }
}
