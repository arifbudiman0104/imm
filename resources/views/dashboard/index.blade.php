<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __("Welcome to Dashboard page!") }}
            </p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                You're logged in as
                <span class="text-indigo-500">
                    {{Auth::user()->name }}.
                </span>
            </p>
        </x-section>
        @if (Auth::user()->dob == null || Auth::user()->pob == null || Auth::user()->gender == null)
        <x-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Your profile is incomplete.
            </p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Please complete your profile to get full access to the system. You can complete your profile by clicking
                the button below.
            </p>
            <div class="mt-4">
                <x-button.create href="{{ route('profile.edit') }}">
                    Complete Profile
                </x-button.create>
            </div>
        </x-section>
        @endif
        @if (Auth::user()->is_verified == false)
        <x-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Your account is not verified. <span class="text-indigo-500">
                    Please contact the administrator.
                </span>
            </p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Without verification, your access to the system is limited. You can still read and comment on
                published posts, but you cannot create new posts.
            </p>
        </x-section>
        @endif



    </div>
</x-app-layout>
