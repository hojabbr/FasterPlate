<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="px-4 mb-6 sm:px-0">
            <h1 class="text-3xl font-bold mb-4">{{ $category->name }}</h1>
            {{ $posts->links() }}
        </div>
        @if ($posts->count())
            <div class="grid grid-cols-1 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white dark:bg-gray-800 shadow sm:rounded">
                        @if ($post->featured_image_path)
                            <img
                                src="{{ Storage::disk($post->featured_image_disk)->url($post->featured_image_path) }}"
                                alt="{{ $post->title }}" class="w-full h-80 object-cover rounded">
                        @endif
                        <div class="p-4">
                        <h2 class="text-xl font-semibold mt-4">{{ $post->title }}</h2>
                        <p class="mt-2">{{ Str::limit(strip_tags($post->body), 100) }}</p>
                        <a
                            href="{{ route('post.show', ['post' => $post->id, 'slug' => $post->slug]) }}"
                            class="text-blue-500 mt-4 inline-block"
                        >
                            Read More
                        </a>
                        </div>
                    </div>
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
