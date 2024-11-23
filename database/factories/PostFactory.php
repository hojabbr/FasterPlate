<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /** @var array $paragraphs */
        $paragraphs = $this->faker->paragraphs(15);
        $body = implode('<br/><br/>', $paragraphs);

        // Randomly select from predefined images
        $imageFileNames = ['1.jpg', '2.jpg', '3.jpg'];
        $selectedImage = $this->faker->randomElement($imageFileNames);

        // Use the predefined video
        $videoFileName = '1.mp4';

        return [
            'title' => $this->faker->unique()->sentence,
            'body' => $body, // Rich HTML content in the body
            'slug' => $this->faker->unique()->slug,
            'is_published' => $this->faker->boolean,

            // Image storage
            'featured_image_path' => 'images/posts/' . $selectedImage,
            'featured_image_disk' => 'public',

            // Video storage
            'video_path' => 'videos/posts/' . $videoFileName,
            'video_disk' => 'public',

            'category_id' => Category::inRandomOrder()->value('id') ?? Category::factory(),
            'user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
        ];
    }
}
