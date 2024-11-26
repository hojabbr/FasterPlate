<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;

class CategoryController extends Controller
{
    public function show(Category $category): View
    {
        $posts = Post::where('category_id', $category->id)->latest()->isPublished()->paginate(10);

        return view('blog.categories.show', [
            'category' => $category,
            'posts' => $posts
        ]);
    }
}
