<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function show(Post $post, string $slug): View
    {
        if(!$post->is_published) {
            abort(404);
        }

        return view('blog.posts.show', [
            'post' => $post,
            'slug' => $slug,
        ]);
    }
}
