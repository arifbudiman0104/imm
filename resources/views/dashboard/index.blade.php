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
        @if (Auth::user()->is_verified)
        <x-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __("Your Statistic") }}
            </p>
            <div class="grid grid-cols-2 gap-5 mt-1 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5">
                <x-card.statistic>
                    <x-slot name="title">
                        {{ __('All Posts') }}
                    </x-slot>
                    {{ $allPosts }}
                </x-card.statistic>
                <x-card.statistic>
                    <x-slot name="title">
                        {{ __('Draft Posts') }}
                    </x-slot>
                    {{ $draftPosts }}
                </x-card.statistic>
                <x-card.statistic>
                    <x-slot name="title">
                        {{ __('Published Posts') }}
                    </x-slot>
                    {{ $publishedPosts }}
                </x-card.statistic>
                <x-card.statistic>
                    <x-slot name="title">
                        {{ __('Approved Posts') }}
                    </x-slot>
                    {{ $approvedPosts }}
                </x-card.statistic>
                <x-card.statistic>
                    <x-slot name="title">
                        {{ __('Published & Approved Posts') }}
                    </x-slot>
                    {{ $publishedApprovedPosts }}
                </x-card.statistic>
                <x-card.statistic>
                    <x-slot name="title">
                        {{ __('Rejected Posts') }}
                    </x-slot>
                    {{ $rejectedPosts }}
                </x-card.statistic>
                <x-card.statistic>
                    <x-slot name="title">
                        {{ __('Requested Posts') }}
                    </x-slot>
                    {{ $requestedPosts }}
                </x-card.statistic>
                <x-card.statistic>
                    <x-slot name="title">
                        {{ __('Total Views') }}
                    </x-slot>
                    {{ $totalViews }}
                </x-card.statistic>
                <x-card.statistic>
                    <x-slot name="title">
                        {{ __('Total Comments') }}
                    </x-slot>
                    {{ $totalComments }}
                </x-card.statistic>
            </div>
        </x-section>
        @endif
        @if (Auth::user()->dob == null || Auth::user()->pob == null || Auth::user()->gender == null ||
        Auth::user()->phone == null || Auth::user()->address == null)
        <x-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Your profile is incomplete.
            </p>
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                To fully utilize the system, kindly update your profile with the following information:
            </p>
            @if (Auth::user()->username == null)
            <p class="mt-1 text-indigo-500 text-md">
                - Username
            </p>
            @endif
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
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                By providing these details, you will assist the administrator with the verification process and ensure
                the accuracy of your profile. Your cooperation in updating your profile will greatly enhance your user
                experience.
            </p>
            <x-button.create href="{{ route('profile.edit') }}" class="mt-4">
                Complete Profile
            </x-button.create>
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
        @endif
        @if (Auth::user()->is_verified)
        <x-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Your account is verified.
            </p>
            @if (Auth::user()->username)
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                Access your page via the navigation bar or by clicking the button.
            </p>
            <x-button.create href="{{route('user.page', Auth::user()->username)}}" class="mt-4">
                My Page
            </x-button.create>
            @else
            <p class="mt-1 text-indigo-600 text-md dark:text-indigo-400">
                Please complete your profile to access your page.
            </p>
            @endif
        </x-section>

        @endif
    </div>
</x-app-layout>
