<div class="flex mt-6">
    @auth
        <button wire:click="toggleLike({{ $model->id }}, '{{ class_basename($model) }}')"
                class="group flex rounded-full transition">
            @elseauth
                <button class="group flex rounded-full transition">
                    @endauth
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="{{ $model->isLikedByCurrentUser() ? 'currentColor' : 'none' }}"
                        viewBox="0 0 24 24"
                        stroke-width="2"
                        stroke="currentColor"
                        class="h-6 w-6 text-red-500 group-hover:text-red-600"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                    </svg>
                    <div class="text-sm ml-1 mt-0.5 text-gray-500">
                        {{ $likesCount }}
                    </div>
                </button>
</div>
