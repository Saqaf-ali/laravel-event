<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        // Define the directory to store images.
        $storagePath = storage_path('app/public/profile_pictures');

        // Ensure the directory exists.
        if (!is_dir($storagePath)) {
            mkdir($storagePath, 0755, true);
        }

        // Generate a unique filename.
        $imageName = fake()->uuid() . '.jpg';
        $imagePath = $storagePath . '/' . $imageName;
        $imageUrl = 'https://i.pravatar.cc/150?img=' . fake()->numberBetween(1, 70);
        file_put_contents($imagePath, file_get_contents($imageUrl));

        if (!$imagePath) {
            return []; // Or handle the error appropriately
        }

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'image' => 'profile_pictures/' . $imageName,
            'email_verified_at' => now(),
            'password' => (static::$password ??= Hash::make('password')),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(
            fn(array $attributes) => [
                'email_verified_at' => null,
            ],
        );
    }
}
