<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <p class="text-lg text-gray-900 font-lg dark:text-gray-100">{{ __("Welcome to Admin page!") }}
            </p>
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                You're logged in as
                <span class="text-red-500">
                    {{Auth::user()->name }}.
                </span>
            </p>
        </x-section>
        <x-section>
            <p class="text-lg text-red-500 font-lg">Attention!</p>
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                Please be aware that this page is only accessible to users with the Admin role, and some actions are irreversible.
            </p>
        </x-section>

    </div>

</x-admin-layout>
