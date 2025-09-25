<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventImage>
 */
class EventImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' =>
                'https://th.bing.com/th/id/R.ca39168088818cbbb5126db2607a94be?rik=tVUMnxXsl9Ksbg&riu=http%3a%2f%2fjonathanlepapillon.j.o.pic.centerblog.net%2fo%2f0a3143b3.jpg&ehk=lL9cfhbTgwVU%2b02XR6SeUK7h6hz49IhgHxYYed2%2bdtQ%3d&risl=&pid=ImgRaw&r=0',

            'event_id' => Event::factory(),
        ];
    }
}
