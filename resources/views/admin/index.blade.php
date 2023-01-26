<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="flex flex-col gap-5">
                <p>{{ __("Welcome to Admin page!") }}</p>
                <p>
                    You're logged in as
                    <span class="text-indigo-500">
                        {{Auth::user()->name }}.
                    </span>
                </p>
                <p>This page can be access only by user with role Admin.</p>
                <p class="text-red-500">
                    Becareful, some features can't be undone.
                </p>
            </div>
        </x-section>
    </div>

</x-admin-layout>
