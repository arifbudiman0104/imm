<div class="grid grid-cols-1 gap-5 xl:hidden lg:grid-cols-2">
    @foreach ($users as $user)
    <div class="p-5 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-500">
        <div class="flex justify-between mb-5">
            @if ($user->is_admin)
            <span
                class="bg-orange-100 text-orange-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">
                Admin
            </span>
            @else
            <span
                class="bg-white text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300">
                User
            </span>
            @endif
            @if ($user->is_verified)
            <span
                class="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                Verified
            </span>
            @endif
        </div>
        <div class="flex mb-5">
            <div class="flex-grow">
                <p class="my-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"> {{
                    $user->name }}</p>
                <p class=""> {{ $user->email }}</p>
            </div>
        </div>
        <div>
            {{-- Remove Admin or Make Admin --}}
            @can('superadmin')
            <div x-cloak x-data="{ showModal: false }" x-on:keydown.window.escape="showModal = false"
                class="inline-flex">
                @if ($user->is_admin)
                <x-default-button x-on:click="showModal = !showModal" x-cloak>
                    Remove Admin
                </x-default-button>
                <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur">
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
                                <x-default-button type="submit">
                                    Yes, Remove Admin
                                </x-default-button>
                            </form>
                            <x-default-button x-on:click="showModal = false">
                                Cancel (Esc)
                            </x-default-button>
                        </div>
                    </div>
                </div>
                @else
                <x-make-admin-button x-on:click="showModal = !showModal" x-cloak>
                    Make Admin
                </x-make-admin-button>
                <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur">
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
                            <form action="{{ route('admin.users.makeadmin', $user->id) }}" method="POST"
                                class="inline-flex">
                                @csrf
                                {{-- @method('DELETE') --}}
                                <x-make-admin-button type="submit">
                                    Yes, Make Admin
                                </x-make-admin-button>
                            </form>
                            <x-default-button x-on:click="showModal = false">
                                Cancel (Esc)
                            </x-default-button>
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
                <x-default-button x-on:click="showModal = !showModal" x-cloak>
                    Unverify
                </x-default-button>
                <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur">
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
                                <x-default-button type="submit">
                                    Yes, Unverify
                                </x-default-button>
                            </form>
                            <x-default-button x-on:click="showModal = false">
                                Cancel (Esc)
                            </x-default-button>
                        </div>
                    </div>
                </div>
                @else
                <x-verify-button x-on:click="showModal = !showModal" x-cloak>
                    Verify
                </x-verify-button>
                <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur">
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
                                <x-verify-button type="submit">
                                    Yes, Verify
                                </x-verify-button>
                            </form>
                            <x-default-button x-on:click="showModal = false">
                                Cancel (Esc)
                            </x-default-button>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Edit --}}
            <x-edit-button href="#">
                {{ __('Edit') }}
            </x-edit-button>

            {{-- Delete --}}
            <div x-cloak x-data="{ showModal: false }" x-on:keydown.window.escape="showModal = false"
                class="inline-flex">
                <x-delete-button x-on:click="showModal = !showModal" x-cloak>
                    Delete
                </x-delete-button>
                <div x-cloak x-show="showModal" x-transition.opacity class="fixed inset-0 z-50 backdrop-blur">
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
                                <x-delete-button type="submit">
                                    Yes, Delete
                                </x-delete-button>
                            </form>
                            <x-default-button x-on:click="showModal = false">
                                Cancel (Esc)
                            </x-default-button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endforeach
</div>
