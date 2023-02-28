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
