<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Organization History') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __("Welcome to Dashboard page!") }}
            </p>
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                Organization History
                {{-- <span class="text-indigo-500">
                    {{Auth::user()->name }}.
                </span> --}}
            </p>
        </x-section>

    </div>
</x-app-layout>
