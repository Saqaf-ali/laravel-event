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
        // Define the directory to store images.
        $storagePath = storage_path('app/public/event_images');

        // Ensure the directory exists.
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        $categories = ['nature', 'city', 'food', 'abstract', 'people', 'tech']; // Define categories for images (e.g., 'nature', 'city', 'food', 'abstract').
        $randomCategory = fake()->randomElement($categories);
        // Generate a unique filename.
        $imageName = fake()->uuid() . '.jpg';
        $imagePath = $storagePath . '/' . $imageName;
        $imageUrl = 'https://picsum.photos/800/600';
        file_put_contents($imagePath, file_get_contents($imageUrl));

        if (!$imagePath) {
            return []; // Or handle the error appropriately
        }

        return [
            'url' => 'event_images/' . $imageName,
        ];
    }
}
