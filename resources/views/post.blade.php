<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Post
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="gap-5 lg:flex">
                <div class="lg:w-2/3">
                    @if ($post->post_category_id != 1 || $post->is_featured == false)
                    <div class="flex justify-between">
                        <div>
                            @if ($post->post_category_id != 1)
                            <div class="font-medium text-indigo-600 uppercase text-md dark:text-indigo-400">
                                {{ $post->post_category->title }}
                            </div>
                            @endif
                        </div>
                        @if ($post->is_featured)
                        <x-badge.post-featured>
                            Featured
                        </x-badge.post-featured>
                        @endif
                    </div>
                    @endif
                    <h2 class="text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        {{ $post->title }}
                    </h2>
                    <div class="flex flex-col justify-between my-5">
                        <div class="flex items-center gap-1 mt-1">
                            <p class="text-gray-900 text-md dark:text-gray-100">
                                {{ $post->user->name }}
                            </p>
                            @if ($post->user->is_verified)
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5 text-indigo-600 dark:text-indigo-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex gap-2 place-items-end shrink-0">
                            <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                {{ $post->published_at->diffForHumans() }}
                            </p>
                            <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                {{ $post->views }}
                                {{ Str::plural('view', $post->views) }}
                            </p>
                        </div>
                    </div>
                    <div class="max-w-2xl prose dark:prose-invert prose-indigo">
                        {!! $post->body !!}
                    </div>
                </div>
                <div class="mt-5 space-y-5 lg:w-1/3 lg:mt-0">
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        Related Post
                    </h2>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-1">
                        @foreach ($related_posts as $post)
                        <x-card.post>
                            <a href="{{ route('post', $post->slug) }}">
                                <div class="flex flex-col justify-between h-full">
                                    <div class="flex flex-col">
                                        @if ($post->post_category_id != 1 || $post->is_featured == false)
                                        <div class="flex justify-between">
                                            <div>
                                                @if ($post->post_category_id != 1)
                                                <div
                                                    class="font-medium text-indigo-600 uppercase text-md dark:text-indigo-400">
                                                    {{ $post->post_category->title }}
                                                </div>
                                                @endif
                                            </div>
                                            @if ($post->is_featured)
                                            <x-badge.post-featured>
                                                Featured
                                            </x-badge.post-featured>
                                            @endif
                                        </div>
                                        @endif
                                        <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                            {{ $post->title }}
                                        </p>
                                        @if ($post->excerpt)
                                        <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                            {{ $post->excerpt }}
                                        </p>
                                        @else
                                        <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                            {{ Str::limit(strip_tags($post->body), 100) }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex flex-col justify-between sm:flex-row lg:flex-col">
                                            <div class="flex items-center gap-1 mt-1">
                                                <p class="text-gray-900 text-md dark:text-gray-100">
                                                    {{ $post->user->name }}
                                                </p>
                                                @if ($post->user->is_verified)
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5 text-indigo-600 dark:text-indigo-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="flex gap-2 place-items-end shrink-0">
                                                <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                                    {{ $post->published_at->diffForHumans() }}
                                                </p>
                                                <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                                    {{ $post->views }}
                                                    {{ Str::plural('view', $post->views) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </x-card.post>
                        @endforeach
                    </div>
                    <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        Recomended Post
                    </h2>
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-1">
                        @foreach ($recommended_posts as $post)
                        <x-card.post>
                            <a href="{{ route('post', $post->slug) }}">
                                <div class="flex flex-col justify-between h-full">
                                    <div class="flex flex-col">
                                        @if ($post->post_category_id != 1 || $post->is_featured == false)
                                        <div class="flex justify-between">
                                            <div>
                                                @if ($post->post_category_id != 1)
                                                <div
                                                    class="font-medium text-indigo-600 uppercase text-md dark:text-indigo-400">
                                                    {{ $post->post_category->title }}
                                                </div>
                                                @endif
                                            </div>
                                            @if ($post->is_featured)
                                            <x-badge.post-featured>
                                                Featured
                                            </x-badge.post-featured>
                                            @endif
                                        </div>
                                        @endif
                                        <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                            {{ $post->title }}
                                        </p>
                                        @if ($post->excerpt)
                                        <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                            {{ $post->excerpt }}
                                        </p>
                                        @else
                                        <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                            {{ Str::limit(strip_tags($post->body), 100) }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="flex flex-col">
                                        <div class="flex flex-col justify-between sm:flex-row lg:flex-col">
                                            <div class="flex items-center gap-1 mt-1">
                                                <p class="text-gray-900 text-md dark:text-gray-100">
                                                    {{ $post->user->name }}
                                                </p>
                                                @if ($post->user->is_verified)
                                                <div>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5 text-indigo-600 dark:text-indigo-400">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                                                    </svg>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="flex gap-2 place-items-end shrink-0">
                                                <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                                    {{ $post->published_at->diffForHumans() }}
                                                </p>
                                                <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                                    {{ $post->views }}
                                                    {{ Str::plural('view', $post->views) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </x-card.post>
                        @endforeach
                    </div>
                </div>

            </div>

        </x-section>


    </div>
</x-guest-layout>
