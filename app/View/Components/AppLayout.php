<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * @var Collection<int, Category> $categories
     */
    public Collection $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->categories = Category::isPublished()->orderBy('order')->get();
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.app');
    }
}
