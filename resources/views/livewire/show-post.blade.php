<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $post->category->name }}
    </h2>
</x-slot>

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="my-2 bg-white dark:bg-gray-800 shadow sm:rounded">
        <h1 class="text-4xl p-4 font-bold mb-4">{{ $post->title }}</h1>
        <div class="text-sm px-4 mb-4">
            <span>By {{ $post->user->name }}</span> |
            <span>{{ $post->created_at->format('M d, Y') }}</span>
        </div>

        @if ($post->featured_image_path)
            <img src="{{ Storage::disk($post->featured_image_disk)->url($post->featured_image_path) }}"
                 alt="{{ $post->title }}" class="w-full object-cover mb-6">
        @endif

        <div class="max-w-none p-4">
            {!! $post->body !!}
        </div>

        @if ($post->video_path)
            <div class="mt-8">
                <video controls class="w-full">
                    <source src="{{ Storage::disk($post->video_disk)->url($post->video_path) }}" type="video/mp4">
                </video>
            </div>
        @endif

        <div class="p-4">
            <button wire:click="toggleLike({{ $post->id }}, 'post')" class="text-blue-500 hover:underline">
                Like Post ({{ $post->likes_count }})
            </button>
        </div>

        <div class="mt-4 p-4">
            <h2 class="text-2xl font-bold mb-4">Comments</h2>

            <ul class="space-y-6">
                @forelse ($post->comments as $comment)
                    <li class="bg-gray-100 p-4 rounded shadow">
                        <div class="text-sm text-gray-600">
                            <span>{{ $comment->user->name ?? 'Anonymous' }}</span>
                            <span>{{ $comment->created_at->format('M d, Y') }}</span>
                        </div>
                        <p class="mt-2">{{ $comment->body }}</p>
                        <div class="mt-2">
                            <button wire:click="toggleLike({{ $comment->id }}, 'comment')"
                                    class="text-blue-500 hover:underline">
                                Like Comment ({{ $comment->likes_count }})
                            </button>
                        </div>
                    </li>
                @empty
                    <li class="text-gray-500">No comments yet. Be the first to comment!</li>
                @endforelse
            </ul>
        </div>

        <div class="p-4">
            <form wire:submit.prevent="submitComment">
                <textarea wire:model="newComment" rows="3" class="form-textarea w-full" placeholder="Add a comment..."
                          required></textarea>
                <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    Submit Comment
                </button>
            </form>
        </div>
    </div>
</div>
