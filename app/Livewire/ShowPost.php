<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ShowPost extends Component
{
    public Post $post;

    public string $newComment = ''; // Temporary property for new comment input

    public bool $commentSubmitted = false;

    protected array $rules = ['newComment' => 'required|string|max:1000',];

    public function mount(Post $post): void
    {
        $this->post = $post->load(['comments' => $this->getApprovedComments(...),])->loadCount('likes');
    }

    public function toggleLike(int $modelId, string $modelType): void
    {
        if (!auth()->check()) {
            return;
        }

        // Dynamically resolve the model
        $model = match ($modelType) {
            'post', 'Post' => Post::findOrFail($modelId),
            'comment', 'Comment' => Comment::findOrFail($modelId),
            default => null,
        };

        if (!$model) {
            return;
        }

        // Toggle like
        $like = $model->likes()->where('user_id', auth()->id());
        $like->exists() ? $like->delete() : $model->likes()->create(['user_id' => auth()->id()]);

        $this->refreshPostData();
    }

    private function refreshPostData(): void
    {
        $this->post->load(['comments' => $this->getApprovedComments(...),])->loadCount('likes');
    }

    public function submitComment(): void
    {
        $this->validate();

        if (auth()->check()) {
            $this->post->comments()->create([
                'body' => $this->newComment,
                'user_id' => auth()->id(),
                'is_approved' => false,
                ]);

            $this->newComment = ''; // Clear the input field
            $this->commentSubmitted = true; // Set the submission state
            $this->refreshPostData();
        }
    }

    private function getApprovedComments(mixed $query): mixed
    {
        return $query->isApproved()->withCount('likes');
    }

    public function render(): View
    {
        return view('components.show-post');
    }
}
