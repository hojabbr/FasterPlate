<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(), // Random existing user or create one
            'likeable_id' => Post::inRandomOrder()->value('id') ?? Post::factory(), // Random existing post or create one
            'likeable_type' => Post::class, // Default to Post
        ];
    }
}
