<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="mb-5">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    All Posts
                </h2>
            </div>
            <div class="mb-5">
                <x-text-input id="search" name="search" type="text" class="w-full md:w-1/2 xl:w-1/4"
                    placeholder="Search by name or email here ..." />
            </div>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 2xl:grid-cols-3">
            {{-- <div class="flex flex-col"> --}}
                @foreach ($posts as $post)
                <x-card.post>
                    <div class="flex flex-col justify-between h-full">
                        <div class="flex flex-col">
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
                            <p class="mt-2 text-lg font-bold text-gray-900 dark:text-gray-100">
                                {{ $post->title }}
                            </p>
                            <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                {{ $post->excerpt }}
                            </p>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex justify-between">
                                <p class="mt-1 text-gray-900 text-md dark:text-gray-100">
                                    {{ $post->user->name }}
                                </p>
                                <p class="mt-1 text-gray-900 text-md dark:text-gray-100">
                                    {{ $post->published_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </x-card.post>
                @endforeach
            </div>
        </x-section>
        <x-section>
            {{ $posts->links() }}
        </x-section>

    </div>
</x-guest-layout>
