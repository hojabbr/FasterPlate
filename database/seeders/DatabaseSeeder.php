<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminUser = User::factory()->withPersonalTeam()->create([
            'email' => 'admin@fasterplate.com',
            'name' => 'FasterPlate Admin',
            'password' => bcrypt('password'),
        ]);

        // Create 5 categories
        Category::factory(5)->create()->each(function ($category) use ($adminUser) {
            // Create 20 posts for each category
            $category->posts()->saveMany(Post::factory(20)->make()->each(function ($post) use ($adminUser) {
                // Assign the admin user to each post
                $post->user_id = $adminUser->id;
                $post->save();

                // Add 1 to 10 tags per post
                $tags = Tag::factory(rand(1, 10))->create();
                $post->tags()->attach($tags);

                // Create 20 comments for each post
                $post->comments()->saveMany(Comment::factory(20)->make()->each(function ($comment) use ($adminUser, $post) {
                    // Assign the admin user to each comment
                    $comment->user_id = $adminUser->id;
                    $comment->commentable_id = $post->id;
                    $comment->commentable_type = Post::class;
                    $comment->save();

                    // Add 0 to 50 likes to each comment
                    Like::factory(rand(0, 20))->create([
                        'likeable_id' => $comment->id,
                        'likeable_type' => Comment::class,
                    ]);
                }));

                // Add 10 to 50 likes to each post
                Like::factory(rand(10, 20))->create([
                    'likeable_id' => $post->id,
                    'likeable_type' => Post::class,
                ]);
            }));
        });
    }
}
