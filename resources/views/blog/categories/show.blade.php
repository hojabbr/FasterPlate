<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @if($posts->links()->paginator->lastPage() > 1)
            <div class="mb-6">{{ $posts->links() }}</div>
        @endif
        @if ($posts->count())
            <div class="grid grid-cols-2 gap-6">
                @foreach ($posts as $post)
                    <a
                        class="bg-white dark:bg-gray-800 shadow sm:rounded hover:shadow-xl transition-shadow"
                        href="{{ route('post.show', ['post' => $post->id, 'slug' => $post->slug]) }}"
                    >
                        @if ($post->featured_image_path)
                            <img
                                src="{{ Storage::disk($post->featured_image_disk)->url($post->featured_image_path) }}"
                                alt="{{ $post->title }}" class="w-full h-80 object-cover rounded">
                        @endif
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mt-4">{{ $post->title }}</h2>
                            <p class="mt-2">{{ Str::limit(strip_tags($post->intro), 500) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <p class="text-gray-600">There are no posts in this category yet.</p>
        @endif
        <div class="px-4 mt-6 sm:px-0">
            {{ $posts->links() }}
        </div>
    </div>
</x-guest-layout>
