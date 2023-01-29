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
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                You're logged in as
                <span class="text-indigo-500">
                    {{Auth::user()->name }}.
                </span>
            </p>
        </x-section>
        @if (Auth::user()->dob == null || Auth::user()->pob == null || Auth::user()->gender == null ||
        Auth::user()->phone == null || Auth::user()->address == null)
        <x-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Your profile is incomplete.
            </p>
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                Please complete your profile to get full access to the system. You can complete your profile by clicking
                the button below.
            </p>
            <x-button.create href="{{ route('profile.edit') }}" class="mt-4">
                Complete Profile
            </x-button.create>
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                Complete your profile by providing all necessary information to facilitate verification by the
                administrator.
            </p>
            @if (Auth::user()->dob == null)
            <p class="mt-1 text-indigo-500 text-md">
                - Date of Birth
            </p>
            @endif
            @if (Auth::user()->pob == null)
            <p class="mt-1 text-indigo-500 text-md">
                - Place of Birth
            </p>
            @endif
            @if (Auth::user()->gender == null)
            <p class="mt-1 text-indigo-500 text-md">
                - Gender
            </p>
            @endif
            @if (Auth::user()->phone == null)
            <p class="mt-1 text-indigo-500 text-md">
                - Phone Number
            </p>
            @endif
            @if (Auth::user()->address== null)
            <p class="mt-1 text-indigo-500 text-md">
                - Address
            </p>
            @endif
        </x-section>
        @endif
        @if (Auth::user()->is_verified == false)
        <x-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Your account is not verified.
            </p>
            <p class="mt-1 text-indigo-600 text-md dark:text-indigo-400">
                Please contact the administrator.
            </p>
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                Without verification, your access to the system is limited. You can still read and comment on
                published posts, but you cannot create new posts.
            </p>
        </x-section>
        @else
        <x-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Your account is verified.
            </p>
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                You can now create new posts and comment on published posts.
            </p>
        </x-section>
        @endif
    </div>
</x-app-layout>
