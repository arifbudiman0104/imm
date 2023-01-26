<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">

        <x-section>
            <div class="mb-5">
                <x-create-button href="">
                    {{ __('Create Post') }}
                </x-create-button>
            </div>
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    All Your Unpublished Post
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Contact admin to publish your post.
                </p>
            </header>
            <main>
                <div>
                    <p>Title</p>
                    <p>excerpt</p>
                </div>
            </main>
        </x-section>
        <x-section>
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    All Your Published Post
                </h2>

                {{-- <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Contact admin to publish your post.
                </p> --}}
            </header>
        </x-section>
    </div>
</x-app-layout>
