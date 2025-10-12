<?php

namespace Database\Seeders;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\Order;
use App\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventIds = Event::pluck('id');
        $attendeeIds = Attendee::pluck('id');
        Order::factory(20)
            ->sequence(
                fn($sequence) => [
                    'attendee_id' => $attendeeIds->random(),
                    'total_price' => fake()->randomFloat(2, 10, 1000),
                    'status' => OrderStatus::cases()[array_rand(OrderStatus::cases())],
                ],
            )
            ->create();
    }
}
