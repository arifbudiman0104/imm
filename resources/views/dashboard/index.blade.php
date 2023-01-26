<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="flex flex-col gap-5">
                <p>{{ __("Welcome to Dashboard page!") }}</p>
                <p>
                    You're logged in as
                    <span class="text-indigo-500">
                        {{Auth::user()->name }}.
                    </span>
                </p>
            </div>
        </x-section>
        @if (Auth::user()->dob == null || Auth::user()->pob == null || Auth::user()->gender == null)
        <x-section>
            <div class="flex flex-col gap-5">
                <p>
                    Please complete your profile <a href="{{ route('profile.edit') }}" class="text-indigo-500">
                        here
                    </a>.
                </p>

            </div>
        </x-section>

        @endif
    </div>
</x-app-layout>
