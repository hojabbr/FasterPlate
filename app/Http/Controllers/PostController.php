<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    public function show(Post $post, string $slug): View
    {
        return view('posts.show', [
            'post' => $post,
            'slug' => $slug,
        ]);
    }
}
