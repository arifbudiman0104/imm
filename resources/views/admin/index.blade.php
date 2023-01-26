<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    {{-- <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                </div>
            </div>
        </div>
    </div> --}}
    <div class="w-full sm:py-12">
        <x-section>
            <p>{{ __("Welcome to Admin!") }}</p>
            <p>
                You're logged in as <span class="text-indigo-500">
                    {{Auth::user()->name }}
                </span>
            </p>
            <p>
                This page can be access only by user with role Admin.
            </p>
        </x-section>
    </div>

</x-admin-layout>
