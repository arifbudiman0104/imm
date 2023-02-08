<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Organization Histories') }}
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
                {{-- @if (request('search'))
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ __('Search results for: ') }} {{ request('search') }}
                </h2>
                @else
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    All Organization Histories
                </h2>
                @endif --}}
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    All Organization Histories
                </h2>
            </div>
            <div class="mb-5 md:w-1/2 2xl:w-1/3">
                <form class="flex items-center gap-2">
                    <x-text-input id="search" name="search" type="text" class="w-full" placeholder="Search by name ..."
                        value="{{ request('search') }}" />
                    <x-button.search type="submit">
                        {{ __('Search') }}
                    </x-button.search>
                </form>
            </div>
            <div>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 2xl:grid-cols-3">
                    @forelse ($organization_histories as $organization_history)
                    <x-card.organization-history-dashboard>
                        <div class="flex flex-col justify-between h-full">
                            <div class="flex flex-col">
                                <div class="flex justify-between gap-1 mb-2">
                                    <div class="flex gap-1">
                                        @if ($organization_history->is_active)
                                        <x-badge.oh-active />
                                        @else
                                        <x-badge.oh-nonactive />
                                        @endif
                                    </div>
                                    <div class="flex gap-1">
                                        @if ($organization_history->is_requested)
                                        <x-badge.oh-requested />
                                        @endif
                                        @if ($organization_history->is_approved)
                                        <x-badge.oh-approved />
                                        @endif
                                    </div>
                                </div>
                                <p class="mt-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $organization_history->user->name }}
                                </p>

                                <p class="text-gray-700 whitespace-nowrap dark:text-gray-400">
                                    {{ $organization_history->start_year }} - {{ $organization_history->end_year }}
                                </p>
                                <p class="text-gray-700 whitespace-nowrap dark:text-gray-400">
                                    {{ $organization_history->organization_position->name }} {{
                                    $organization_history->organization_field->name }}
                                </p>
                                <p class="text-gray-700 whitespace-nowrap dark:text-gray-400">
                                    {{ $organization_history->organization->name }}
                                </p>
                                <div class="mt-5">
                                    {{-- Edit --}}
                                    <x-button.edit
                                        href="{{ route('admin.organization-histories.edit', $organization_history->id) }}">
                                        {{ __('Edit') }}
                                    </x-button.edit>
                                    {{-- Delete --}}
                                    <div x-cloak x-data="{ showModal: false }"
                                        x-on:keydown.window.escape="showModal = false" class="inline-flex">
                                        <x-button.delete x-on:click="showModal = !showModal" x-cloak>
                                            Delete
                                        </x-button.delete>
                                        <div x-cloak x-show="showModal" x-transition.opacity
                                            class="fixed inset-0 z-50 bg-red-600/30 dark:bg-red-500/30 backdrop-blur-xl">
                                        </div>
                                        <div x-cloak x-show="showModal" x-transition
                                            class="fixed inset-0 z-50 flex items-center justify-center p-6">
                                            <div x-on:click.away="showModal = false"
                                                class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                                                <div class="p-5">
                                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        {{ __('Are you sure you want to delete this organization
                                                        history?') }}
                                                    </h2>
                                                    <p class="mt-1 mb-5 text-sm text-red-600 dark:text-red-400">
                                                        This action is irreversible and will delete all the data related
                                                        to this user.
                                                    </p>
                                                    <form
                                                        action="{{ route('admin.organization-histories.destroy', $organization_history->id) }}"
                                                        method="POST" class="inline-flex">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-button.delete type="submit">
                                                            Yes, Delete
                                                        </x-button.delete>
                                                    </form>
                                                    <x-button.default x-on:click="showModal = false">
                                                        Cancel (Esc)
                                                    </x-button.default>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </x-card.organization-history-dashboard>
                    @empty
                    <div class="p-5 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-500">
                        <p class="text-gray-500 text-md dark:text-gray-400">
                            {{ __('No Organization History found!') }}
                        </p>
                    </div>
                    @endforelse
                </div>
            </div>
            {{-- <div class="mb-5 md:w-1/2 2xl:w-1/3">
                <form class="flex items-center gap-2">
                    <x-text-input id="search" name="search" type="text" class="w-full"
                        placeholder="Search by name or email ..." value="{{ request('search') }}" />
                    <x-button.search type="submit">
                        {{ __('Search') }}
                    </x-button.search>
                </form>
            </div> --}}
            {{-- @include('admin.users.list')
            @include('admin.users.table') --}}
        </x-section-admin>
        @if ($organization_histories->hasPages())
        <x-section-admin>
            {{ $organization_histories->links() }}
        </x-section-admin>
        @endif
    </div>
</x-admin-layout>
