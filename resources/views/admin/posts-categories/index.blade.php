<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Post Categories') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section-admin>
            {{-- <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Posts Categories
            </h2> --}}
            <div class="mb-5">
                <x-button.create href="{{ route('admin.post-categories.create') }}">
                    {{ __('Create') }}
                </x-button.create>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4">
                @foreach ($postsCategories as $postsCategory)
                <x-card.posts-categories-admin>
                    <div class="flex justify-between">
                        <div>
                            <p class="mt-1 font-medium text-gray-900 dark:text-white">
                                {{ $postsCategory->title }}
                            </p>
                        </div>
                        <div class="mt-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $postsCategory->posts->count() }} posts
                        </div>
                    </div>
                    <p class="text-gray-700 dark:text-gray-400">
                        slug : {{ $postsCategory->slug }}
                    </p>
                    <p class="text-gray-700 dark:text-gray-400">
                        description : {{ $postsCategory->description }}
                    </p>
                    {{-- @if ($postsCategory->posts->count() > 0)
                    <div class="flex flex-col mt-2">
                        <p class="text-green-700 dark:text-green-400">
                            {{ $postsCategory->posts->where('is_approved', true)->count() }} posts approved
                        </p>
                        <p class="text-red-700 dark:text-red-400">
                            {{ $postsCategory->posts->where('is_approved', false)->count() }} posts unapproved
                        </p>
                    </div>
                    @endif --}}
                </x-card.posts-categories-admin>
                @endforeach
            </div>

        </x-section-admin>
    </div>
</x-admin-layout>
