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
                            <x-badge.verified />
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
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Related Post
                        </h2>
                        <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-1">
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
                                                        <x-badge.verified />
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
                    <div class="hidden lg:block">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Recomended Post
                        </h2>
                        <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-1">
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
                                                    <x-badge.verified />
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
            </div>
        </x-section>
        <div class="mx-auto sm:mb-5 max-w-7xl">
            <div class="w-full lg:w-2/3">
                <x-section>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Comment
                    </h2>
                    <div class="mt-5" class="flex flex-col">
                        <textarea id="message" rows="4" name="excerpt" maxlength="255"
                            class="w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                            placeholder="Write your comment here"></textarea>
                        <x-button.comment class="mt-5">
                            Send
                        </x-button.comment>
                    </div>
                    <div class="flex flex-col gap-5 mt-5">
                        <div class="p-5 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-500">
                            <div x-data="{ showEdit: false }">
                                <div class="flex justify-between ">
                                    <div class="flex flex-row items-center gap-2">
                                        <div class="flex items-center">
                                            <p class="text-gray-500 text-md dark:text-gray-400">
                                                Admin
                                            </p>
                                            <div class="ml-1">
                                                <x-badge.verified />
                                            </div>
                                        </div>
                                        <div class="flex gap-2 place-items-end shrink-0">
                                            <p class="text-xs text-gray-500 text-md dark:text-gray-400">
                                                1 hour ago
                                            </p>
                                        </div>
                                    </div>
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button
                                                class="flex items-center justify-center w-6 h-6 text-gray-400 rounded-full hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 dark:focus:ring-indigo-600">
                                                <span class="sr-only">Open options</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            <x-dropdown-link href="#" x-on:click.prevent="showEdit = !showEdit"
                                                x-text="showEdit ? 'Cancel Edit' : 'Edit'">
                                                Edit
                                            </x-dropdown-link>
                                            <x-dropdown-link href="#">
                                                Delete
                                            </x-dropdown-link>
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                                <p class="text-gray-900 text-md dark:text-gray-100">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, molestiae?
                                </p>
                                <div class="mt-5" class="flex flex-col" x-cloak x-show="showEdit">
                                    <textarea id="message" rows="4" name="excerpt" maxlength="255"
                                        class="w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                        placeholder="Write your comment here"></textarea>
                                    <x-button.comment class="mt-5">
                                        Save
                                    </x-button.comment>
                                    <x-button.default class="mt-5" x-on:click.prevent="showEdit = !showEdit">
                                        Cancel
                                    </x-button.default>
                                </div>
                            </div>

                        </div>

                    </div>
                </x-section>
            </div>
        </div>





    </div>
</x-guest-layout>
