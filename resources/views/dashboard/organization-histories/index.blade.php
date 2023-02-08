<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Organization History') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="mb-5">
                <x-button.create href="{{ route('dashboard.organization-histories.create') }}">
                    {{ __('Create') }}
                </x-button.create>
            </div>
            <div class="flex flex-col justify-end md:flex-row">
                <div class="flex items-center">
                    @if (session('status') === 'organization-history-created')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                        class="py-5 text-sm text-green-600 lg:pt-0 dark:text-green-400">{{ __('Created.') }}</p>
                    @endif
                </div>
            </div>
            <div>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                    @forelse ($organization_histories as $organization_history)
                    <x-card.organization-history-dashboard>
                        <div class="flex flex-col justify-between h-full">
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
                                    href="{{ route('dashboard.organization-histories.edit', $organization_history->id) }}">
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
                                                    {{ __('Are you sure you want to delete this organization history?')
                                                    }}
                                                </h2>
                                                <p class="mt-1 mb-5 text-sm text-red-600 dark:text-red-400">
                                                    This action is irreversible and will delete all the data related
                                                    to this user.
                                                </p>
                                                <form
                                                    action="{{ route('dashboard.organization-histories.destroy', $organization_history->id) }}"
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
        </x-section>

    </div>
</x-app-layout>
