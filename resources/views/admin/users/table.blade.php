<div class="hidden xl:block">
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Role
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Verified
                    </th>
                    <th scope="col" class="px-2 py-3">
                        Action
                    </th>
                    @can('superadmin')
                    <th scope="col" class="px-2 py-3">
                    </th>
                    <th scope="col" class="px-2 py-3">
                    </th>
                    @endcan
                    <th scope="col" class="px-2 py-3">
                    </th>
                    <th scope="col" class="px-2 py-3">
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">

                    {{-- Name --}}
                    <th scope="row" class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->name }}
                    </th>

                    {{-- Email --}}
                    <td class="px-2 py-4">
                        {{ $user->email }}
                    </td>

                    {{-- Role --}}
                    <td class="px-2 py-3 ">
                        @if ($user->is_admin && !$user->is_superadmin)
                        <span
                            class="bg-orange-100 text-orange-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">
                            Admin
                        </span>
                        @elseif ($user->is_admin && $user->is_superadmin)
                        <span
                            class="bg-orange-100 text-orange-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">
                            Superadmin
                        </span>
                        @else
                        User
                        @endif
                    </td>

                    {{-- Verified --}}
                    <td class="px-2 py-3 ">
                        @if ($user->is_verified)
                        <span
                            class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                            Verified
                        </span>
                        @else
                        Not Verify
                        @endif
                    </td>

                    {{-- Remove Admin or Make Admin --}}
                    @can('superadmin')
                    <td class="px-2 py-3" x-cloak x-data="{ showModal: false }"
                        x-on:keydown.window.escape="showModal = false">
                        @if ($user->is_superadmin)
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-gray-500 dark:text-gray-400 hover:underline">
                            Remove Superadmin
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl">
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
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-orange-600 dark:text-orange-500 hover:underline">
                            Make Superadmin
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl">
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
                                        <x-make-admin-button type="submit">
                                            Yes, Make Superadmin
                                        </x-make-admin-button>
                                    </form>
                                    <x-default-button x-on:click="showModal = false">
                                        Cancel (Esc)
                                    </x-default-button>
                                </div>
                            </div>
                        </div>
                        @endif
                    </td>
                    <td class="px-2 py-3" x-cloak x-data="{ showModal: false }"
                        x-on:keydown.window.escape="showModal = false">
                        @if ($user->is_admin)
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-gray-500 dark:text-gray-400 hover:underline">
                            Remove Admin
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl">
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
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-orange-600 dark:text-orange-500 hover:underline">
                            Make Admin
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl">
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
                    </td>
                    @endcan

                    {{-- Verify or Unverify --}}
                    <td class="px-2 py-3" x-cloak x-data="{ showModal: false }"
                        x-on:keydown.window.escape="showModal = false">
                        @if ($user->is_verified)
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-gray-500 dark:text-gray-400 hover:underline">
                            Unverify
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl">
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
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-green-600 dark:text-green-500 hover:underline">
                            Verify
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl">
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
                    </td>

                    {{-- Edit --}}
                    <td class="px-2 py-3">
                        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                    </td>

                    {{-- Delete --}}
                    <td class="px-2 py-3" x-cloak x-data="{ showModal: false }"
                        x-on:keydown.window.escape="showModal = false">
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                            Delete
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl">
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

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
