<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class LikeButton extends Component
{
    public Model $model;
    public int|null $likesCount;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $model, int|null $likesCount)
    {
        $this->model = $model;
        $this->likesCount = $likesCount;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render(): View
    {
        return view('components.like-button');
    }
}
