<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('System') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section-admin>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 2xl:grid-cols-3">
                @foreach ($systems as $system)
                <div class="p-5 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-500">
                    <div>
                        <div class="flex justify-between">
                            <p class="text-lg font-medium text-gray-900 uppercase dark:text-gray-100">
                                {{ $system->name }}
                            </p>
                            <div class="shrink-0">
                                @if ($system->is_active)
                                <x-badge.system-enable />
                                @else
                                <x-badge.system-disable />
                                @endif
                            </div>
                        </div>
                        <p class="mt-1 mb-5 text-gray-600 text-md dark:text-gray-400">
                            {{ $system->description }}
                        </p>
                        <div>
                            @can('admin')
                            <div x-cloak x-data="{ showModal: false }" x-on:keydown.window.escape="showModal = false"
                                class="inline-flex">
                                @if ($system->is_active)
                                {{-- @if ($user->is_superadmin) --}}
                                <x-button.default x-on:click="showModal = !showModal" x-cloak>
                                    Disable
                                </x-button.default>
                                <div x-cloak x-show="showModal" x-transition.opacity
                                    class="fixed inset-0 z-50 backdrop-blur-xl">
                                </div>
                                <div x-cloak x-show="showModal" x-transition
                                    class="fixed inset-0 z-50 flex items-center justify-center p-6">
                                    <div x-on:click.away="showModal = false"
                                        class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                                        <div class="p-5">
                                            <h2 class="mb-5 text-lg font-medium text-gray-900 dark:text-gray-100">
                                                Are you sure you want to disable {{ $system->name }}?
                                            </h2>
                                            <form action="{{ route('admin.systems.disable', $system) }}"
                                                method="POST" class="inline-flex">
                                                @csrf
                                                <x-button.default type="submit">
                                                    Yes, Disable
                                                </x-button.default>
                                            </form>
                                            <x-button.default x-on:click="showModal = false">
                                                Cancel (Esc)
                                            </x-button.default>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <x-button.make-admin x-on:click="showModal = !showModal" x-cloak>
                                    Enable
                                </x-button.make-admin>
                                <div x-cloak x-show="showModal" x-transition.opacity
                                    class="fixed inset-0 z-50 backdrop-blur-xl">
                                </div>
                                <div x-cloak x-show="showModal" x-transition
                                    class="fixed inset-0 z-50 flex items-center justify-center p-6">
                                    <div x-on:click.away="showModal = false"
                                        class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                                        <div class="p-5">
                                            <h2 class="mb-5 text-lg font-medium text-gray-900 dark:text-gray-100">
                                                Are you sure you want to enable {{ $system->name }}?
                                            </h2>
                                            <form action="{{ route('admin.systems.enable', $system) }}"
                                                method="POST" class="inline-flex">
                                                @csrf
                                                <x-button.make-admin type="submit">
                                                    Yes, Enable
                                                </x-button.make-admin>
                                            </form>
                                            <x-button.default x-on:click="showModal = false">
                                                Cancel (Esc)
                                            </x-button.default>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endcan

                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </x-section-admin>
    </div>
</x-admin-layout>
