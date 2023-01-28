<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        @if (Auth::user()->is_superadmin == false)
        <x-section>
            <p class="text-lg font-medium text-indigo-500">Info!</p>
            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Only user with role
                <x-badge.superadmin />
                can change user role.
            </p>
        </x-section>
        @endif
        <x-section>
            <div class="mb-5">
                <x-button.create href="{{ route('admin.users.create') }}" class="shrink-0">
                    {{ __('Create User') }}
                </x-button.create>
            </div>

            <div class="mb-5">
                <x-text-input id="search" name="search" type="text" class="w-full md:w-1/2 xl:w-1/4"
                    placeholder="Search by name or email here ..." />
            </div>

            @include('admin.users.list')
            @include('admin.users.table')
        </x-section>
        <x-section>
            {{ $users->links() }}
        </x-section>
    </div>
</x-admin-layout>
