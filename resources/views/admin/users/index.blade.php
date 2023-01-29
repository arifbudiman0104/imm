<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        @if (Auth::user()->is_superadmin == false)
        <x-section>
            <p class="text-lg font-medium text-indigo-500">Attention!</p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                - User with role
                <x-badge.superadmin />
                can do everything.
            </p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                - User with role
                <x-badge.admin />
                can only verify user with
                <x-badge.completed /> badge.
            </p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                -
                <x-badge.verified /> badge means user can create post, but need user with
                <x-badge.admin /> role to approve the post.
            </p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                - Delete user will delete all post and comment from that user.
            </p>
        </x-section>
        @endif
        <x-section>
            <div class="mb-5">
                <x-button.create href="{{ route('admin.users.create') }}" class="shrink-0">
                    {{ __('Create User') }}
                </x-button.create>
            </div>
            <div class="flex flex-col justify-between md:flex-row">
                <div>
                    <div class="mb-5">
                        <x-text-input id="search" name="search" type="text" class="w-full"
                            placeholder="Search by name or email here ..." />
                    </div>
                </div>
                <div class="flex items-center">

                    @if (session('status') === 'user-admin')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 dark:text-green-400">{{ __('Successfuly change user role to
                        Admin.') }}</p>
                    @endif

                    @if (session('status') === 'user-not-admin')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 dark:text-green-400">{{ __('Successfuly change user role to
                        User.') }}</p>
                    @endif

                    @if (session('status') === 'user-superadmin')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 dark:text-green-400">{{ __('Successfuly change user role to
                        Superadmin.') }}</p>
                    @endif

                    @if (session('status') === 'user-not-superadmin')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 dark:text-green-400">{{ __('Successfuly change user role to
                        User.') }}</p>
                    @endif

                    @if (session('status') === 'user-verified')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 dark:text-green-400">{{ __('Successfuly verified user.') }}
                    </p>
                    @endif

                    @if (session('status') === 'user-not-verified')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-red-600 dark:text-red-400">{{ __("Failed verified user, Make sure user
                        profile is complete.") }}</p>
                    @endif

                    @if (session('status') === 'user-unverified')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 dark:text-green-400">{{ __('Successfuly unverified user.') }}
                    </p>
                    @endif

                    @if (session('status') === 'user-deleted')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 dark:text-green-400">{{ __('Successfuly delete user.') }}
                    </p>
                    @endif
                </div>

            </div>


            @include('admin.users.list')
            @include('admin.users.table')
        </x-section>
        <x-section>
            {{ $users->links() }}
        </x-section>
    </div>
</x-admin-layout>
