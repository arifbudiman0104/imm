<div class="grid grid-cols-1 gap-5 xl:hidden lg:grid-cols-2">
    @foreach ($users as $user)
    {{-- <div class="p-5 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-500"> --}}
        <x-card.user>
            <div class="flex justify-between mb-5">
                @if ($user->is_admin && !$user->is_superadmin)
                <x-badge.admin />
                @elseif ($user->is_admin && $user->is_superadmin)
                <x-badge.superadmin />
                @else
                <span
                    class="bg-white text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300">
                    User
                </span>
                @endif
                <div>
                    @if ($user->is_verified)
                    <x-badge.verified />
                    @endif
                    @if ($user->dob !== null || $user->pob !== null || $user->gender !== null ||
                    $user->phone !== null || $user->address !== null)
                    <x-badge.completed />
                    @endif
                </div>
            </div>
            <div class="flex mb-5">
                <div class="flex-grow">
                    <p class="my-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"> {{
                        $user->name }}</p>
                    <p class=""> {{ $user->email }}</p>
                </div>
            </div>
            <div>
                @can('superadmin')
                {{-- Remove Superadmin or Make Admin --}}
                <div x-cloak x-data="{ showModal: false }" x-on:keydown.window.escape="showModal = false"
                    class="inline-flex">
                    @if ($user->is_superadmin)
                    <x-button.default x-on:click="showModal = !showModal" x-cloak>
                        Remove Superadmin
                    </x-button.default>
                    <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur-xl">
                    </div>
                    <div x-cloak x-show="showModal" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center p-6">
                        <div x-on:click.away="showModal = false"
                            class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                            <div class="p-5">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to remove Superadmin this user?') }}
                                </h2>
                                <div class="mb-5">
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->name }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <form action="{{ route('admin.users.removesuperadmin', $user->id) }}" method="POST"
                                    class="inline-flex">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <x-button.default type="submit">
                                        Yes, Remove Admin
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
                        Make Superadmin
                    </x-button.make-admin>
                    <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur-xl">
                    </div>
                    <div x-cloak x-show="showModal" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center p-6">
                        <div x-on:click.away="showModal = false"
                            class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                            <div class="p-5">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to make Superadmin this user?') }}
                                </h2>
                                <div class="mb-5">
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->name }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <form action="{{ route('admin.users.makesuperadmin', $user->id) }}" method="POST"
                                    class="inline-flex">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <x-button.make-admin type="submit">
                                        Yes, Make Superadmin
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
                {{-- Remove Admin or Make Admin --}}
                <div x-cloak x-data="{ showModal: false }" x-on:keydown.window.escape="showModal = false"
                    class="inline-flex">
                    @if ($user->is_admin)
                    <x-button.default x-on:click="showModal = !showModal" x-cloak>
                        Remove Admin
                    </x-button.default>
                    <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur-xl">
                    </div>
                    <div x-cloak x-show="showModal" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center p-6">
                        <div x-on:click.away="showModal = false"
                            class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                            <div class="p-5">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to remove Admin this user?') }}
                                </h2>
                                <div class="mb-5">
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->name }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <form action="{{ route('admin.users.removeadmin', $user->id) }}" method="POST"
                                    class="inline-flex">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <x-button.default type="submit">
                                        Yes, Remove Admin
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
                        Make Admin
                    </x-button.make-admin>
                    <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur-xl">
                    </div>
                    <div x-cloak x-show="showModal" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center p-6">
                        <div x-on:click.away="showModal = false"
                            class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                            <div class="p-5">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to make Admin this user?') }}
                                </h2>
                                <div class="mb-5">
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->name }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <form action="{{ route('admin.users.makeadmin', $user->id) }}" method="POST"
                                    class="inline-flex">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <x-button.make-admin type="submit">
                                        Yes, Make Admin
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

                {{-- Verify or Unverify --}}
                <div x-cloak x-data="{ showModal: false }" x-on:keydown.window.escape="showModal = false"
                    class="inline-flex">
                    @if ($user->is_verified)
                    <x-button.default x-on:click="showModal = !showModal" x-cloak>
                        Unverify
                    </x-button.default>
                    <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur-xl">
                    </div>
                    <div x-cloak x-show="showModal" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center p-6">
                        <div x-on:click.away="showModal = false"
                            class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                            <div class="p-5">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to unverify this user?') }}
                                </h2>
                                <div class="mb-5">
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->name }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <form action="{{ route('admin.users.unverify', $user->id) }}" method="POST"
                                    class="inline-flex">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <x-button.default type="submit">
                                        Yes, Unverify
                                    </x-button.default>
                                </form>
                                <x-button.default x-on:click="showModal = false">
                                    Cancel (Esc)
                                </x-button.default>
                            </div>
                        </div>
                    </div>
                    @else
                    <x-button.verify x-on:click="showModal = !showModal" x-cloak>
                        Verify
                    </x-button.verify>
                    <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur-xl">
                    </div>
                    <div x-cloak x-show="showModal" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center p-6">
                        <div x-on:click.away="showModal = false"
                            class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                            <div class="p-5">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to verify this user?') }}
                                </h2>
                                <div class="mb-5">
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->name }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                                <form action="{{ route('admin.users.verify', $user->id) }}" method="POST"
                                    class="inline-flex">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <x-button.verify type="submit">
                                        Yes, Verify
                                    </x-button.verify>
                                </form>
                                <x-button.default x-on:click="showModal = false">
                                    Cancel (Esc)
                                </x-button.default>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Edit --}}
                <x-button.edit href="#">
                    {{ __('Edit') }}
                </x-button.edit>

                {{-- Delete --}}
                <div x-cloak x-data="{ showModal: false }" x-on:keydown.window.escape="showModal = false"
                    class="inline-flex">
                    <x-button.delete x-on:click="showModal = !showModal" x-cloak>
                        Delete
                    </x-button.delete>
                    <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur-xl">
                    </div>
                    <div x-cloak x-show="showModal" x-transition
                        class="fixed inset-0 z-50 flex items-center justify-center p-6">
                        <div x-on:click.away="showModal = false"
                            class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                            <div class="p-5">
                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Are you sure you want to verify this user?') }}
                                </h2>
                                <div class="mb-5">
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->name }}
                                    </p>
                                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                                        This action is irreversible and will delete all the data related
                                        to this user.
                                    </p>
                                </div>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                    class="inline-flex">
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
        </x-card.user>
        @endforeach
    </div>
