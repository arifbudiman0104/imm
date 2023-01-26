<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <p>{{ __("Welcome to Dashboard!") }}</p>
            <p>
                You're logged in as <span class="text-indigo-500">
                    {{Auth::user()->name }}
                </span>
            </p>
        </x-section>
    </div>
</x-app-layout>
