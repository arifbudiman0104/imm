<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="mb-5">
                <x-create-button href="{{ route('admin.users.create') }}" class="shrink-0">
                    {{ __('Create User') }}
                </x-create-button>
            </div>

            {{-- <div class="mb-5">
                <x-text-input id="search" name="search" type="text" class="w-full md:w-1/2 xl:w-1/4"
                    placeholder="Search by name or email here ..." />
            </div> --}}

            @include('admin.users.list')
            @include('admin.users.table')
        </x-section>
        <div class="mx-auto sm:mb-5 max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-visible">
                <div class="text-gray-900 dark:text-gray-100">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
        {{-- <x-section>
            {{ $users->links() }}
        </x-section> --}}
    </div>
</x-admin-layout>
