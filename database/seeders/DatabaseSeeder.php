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
        // 1. حذف المجلد القديم لضمان بداية نظيفة
        Storage::disk('public')->deleteDirectory('event_images');
        // 2. إنشاء المجلد مرة أخرى
        Storage::disk('public')->makeDirectory('event_images');

        User::factory()
            ->has(
                Organizer::factory()->has(
                    Event::factory()
                        ->count(10)
                        ->has(EventImage::factory()->count(3))
                        ->has(Ticket::factory()->count(3)),
                ),
            )
            ->create();
    }
}
