<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $post->category->name }}
    </h2>
</x-slot>

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-gray-800 shadow sm:rounded">
        <h1 class="text-4xl p-4 font-bold mb-4">{{ $post->title }}</h1>
        <div class="text-sm px-4 mb-4">
            By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
            ({{ $post->created_at->diffForHumans() }})
        </div>

        @if ($post->featured_image_path)
            <img src="{{ Storage::disk($post->featured_image_disk)->url($post->featured_image_path) }}"
                 alt="{{ $post->title }}" class="w-full object-cover mb-6">
        @endif

        <div class="max-w-none p-4">
            <h3 class="text-xl">{{ $post->intro }}</h3>
        </div>

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

        @if($post->category->likeable)
            <div class="px-4 mb-4">
                <x-like-button :model="$post" :likes-count="$post->likes_count"/>
            </div>
            <div class="text-sm px-4 pb-4">
                By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}
                ({{ $post->created_at->diffForHumans() }})
            </div>
        @endif

        @if($post->category->commentable)
            <div class="mt-4 p-4">
                <h2 class="text-2xl font-bold mb-4">Comments</h2>

                <ul class="space-y-6">
                    @forelse ($post->comments as $comment)
                        <li class="bg-gray-50 dark:bg-gray-700 p-4 hover:bg-gray-100 dark:hover:bg-gray-600 hover:shadow">
                            <div class="text-sm text-gray-600 dark:text-gray-500">
                                <span>{{ $comment->user->name ?? 'Anonymous' }} - </span>
                                <span>{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-2">{{ $comment->body }}</p>
                            <x-like-button :model="$comment" :likes-count="$comment->likes_count"/>
                        </li>
                    @empty
                        <li class="text-gray-500">No comments yet. Be the first to comment!</li>
                    @endforelse
                </ul>
            </div>

            @auth
                <div class="p-4">
                    @if ($commentSubmitted)
                        <p class="text-sm text-gray-500">
                            Thank you for your comment! It will be displayed after approval by the moderator.
                        </p>
                    @else
                        <form wire:submit.prevent="submitComment">
                            <x-textarea wire:model="newComment" rows="3" class="w-full" placeholder="Add a comment..."
                                        required></x-textarea>
                            <x-button class="mt-4">Submit Comment</x-button>
                        </form>
                    @endif
                </div>
            @endauth
        @endif
    </div>
</div>
