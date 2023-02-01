<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="flex items-center">
                <div class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ $user->name }}
                </div>
                <span class="ml-2">
                    <x-badge.verified />
                </span>
            </div>
            <div>
                @if ($user->hide_email == false)
                {{ $user->email }}
                @endif
            </div>
            <div class="mt-2">
                @if ($user->bio)
                <p class="text-gray-500 text-md dark:text-gray-400">
                    {{ $user->bio }}
                </p>
                @else
                <p class="text-gray-500 text-md dark:text-gray-400">
                    {{ $user->name }} has not written a bio yet.
                </p>
                @endif
            </div>
            @if ($user->instagram)
            <div class="mt-5">
                <a href="{{ $user->instagram }}" data-mdb-ripple="true" data-mdb-ripple-color="light"
                    class="inline-block px-6 py-2.5 mb-2 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out"
                    style="background-color: #c13584;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-4 h-4">
                        <path fill="currentColor"
                            d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                    </svg>
                </a>
            </div>
            @endif



        </x-section>
        <x-section>
            <div class="mb-5">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Posted by {{ $user->name }}
                </h2>
            </div>
            {{-- <div class="mb-5">
                <x-text-input id="search" name="search" type="text" class="w-full md:w-1/2 xl:w-1/4"
                    placeholder="Search by name or email here ..." />
            </div> --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:grid-cols-3">
                @foreach ($posts as $post)
                <x-card.post-public>
                    <a href="{{ route('post', $post->slug) }}">
                        <div class="flex flex-col justify-between h-full">
                            <div class="flex flex-col">
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
                                <div class="flex flex-col justify-between sm:flex-row 2xl:flex-col">
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

                </x-card.post-public>
                @endforeach
            </div>
        </x-section>
        @if ($posts->hasPages())
        <x-section>
            {{ $posts->links() }}
        </x-section>
        @endif
        {{-- <x-section>
            <div class="mb-5">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    All Posts
                </h2>
            </div>
            <div class="mb-5">
                <x-text-input id="search" name="search" type="text" class="w-full md:w-1/2 xl:w-1/4"
                    placeholder="Search by name or email here ..." />
            </div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:grid-cols-3">
                @foreach ($posts as $post)
                <x-card.post-public>
                    <a href="{{ route('post', $post->slug) }}">
                        <div class="flex flex-col justify-between h-full">
                            <div class="flex flex-col">
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
                                <div class="flex flex-col justify-between sm:flex-row 2xl:flex-col">
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

                </x-card.post-public>
                @endforeach
            </div>
        </x-section>
        @if ($posts->hasPages())
        <x-section>
            {{ $posts->links() }}
        </x-section>
        @endif --}}

    </div>
</x-guest-layout>
