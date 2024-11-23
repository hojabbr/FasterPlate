<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => $this->faker->sentence,
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(), // Random existing user or create one
            'commentable_id' => Post::inRandomOrder()->value('id') ?? Post::factory(), // Random existing post or create one
            'commentable_type' => Post::class,  // Default to Post
            'is_approved' => true,
        ];
    }
}
