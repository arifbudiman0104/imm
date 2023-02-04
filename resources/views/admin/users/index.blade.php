<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">

        <x-section-admin>
            {{-- <div class="mb-5">
                <x-button.create href="{{ route('admin.users.create') }}" class="shrink-0">
                    {{ __('Create User') }}
                </x-button.create>
            </div> --}}
            <div class="mb-5">
                @if (request('search'))
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ __('Search results for: ') }} {{ request('search') }}
                </h2>
                @else
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    All Users
                </h2>
                @endif
            </div>
            <div class="mb-5 md:w-1/2 2xl:w-1/3">
                <form class="flex items-center gap-2">
                    <x-text-input id="search" name="search" type="text" class="w-full" placeholder="Search by name or email ..."
                        value="{{ request('search') }}" />
                    <x-button.search type="submit">
                        {{ __('Search') }}
                    </x-button.search>
                </form>
            </div>
            <div class="flex flex-col justify-end md:flex-row">
                <div class="flex items-center">

                    @if (session('status') === 'user-admin')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 lg:pt-0 dark:text-green-400">{{ __('Successfuly change user
                        role to
                        Admin.') }}</p>
                    @endif

                    @if (session('status') === 'user-not-admin')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 lg:pt-0 dark:text-green-400">{{ __('Successfuly change user
                        role to
                        User.') }}</p>
                    @endif

                    @if (session('status') === 'user-superadmin')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 lg:pt-0 dark:text-green-400">{{ __('Successfuly change user
                        role to
                        Superadmin.') }}</p>
                    @endif

                    @if (session('status') === 'user-not-superadmin')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 lg:pt-0 dark:text-green-400">{{ __('Successfuly change user
                        role to
                        User.') }}</p>
                    @endif

                    @if (session('status') === 'user-verified')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 lg:pt-0 dark:text-green-400">{{ __('Successfuly verified
                        user.') }}
                    </p>
                    @endif

                    @if (session('status') === 'user-not-verified')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-red-600 lg:pt-0 dark:text-red-400">{{ __("Failed verified user, Make
                        sure user
                        profile is complete.") }}</p>
                    @endif

                    @if (session('status') === 'user-unverified')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 lg:pt-0 dark:text-green-400">{{ __('Successfuly unverified
                        user.') }}
                    </p>
                    @endif

                    @if (session('status') === 'user-deleted')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 lg:pt-0 dark:text-green-400">{{ __('Successfuly delete
                        user.') }}
                    </p>
                    @endif
                </div>

            </div>
            @include('admin.users.list')
            @include('admin.users.table')
        </x-section-admin>
        @if ($users->hasPages())
        <x-section-admin>
            {{ $users->links() }}
        </x-section-admin>
        @endif
    </div>
</x-admin-layout>
