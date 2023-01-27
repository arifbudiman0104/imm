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
                        @if ($user->is_admin)
                        <x-default-button>
                            {{ __('Make User') }}
                        </x-default-button>
                        @else
                        <x-make-admin-button>
                            {{ __('Make Admin') }}
                        </x-make-admin-button>
                        @endif
                        @if ($user->is_verified)
                        <x-default-button>
                            {{ __('Unverify') }}
                        </x-default-button>
                        @else
                        <x-verify-button>
                            {{ __('Verify') }}
                        </x-verify-button>
                        @endif
                        <x-edit-button>
                            {{ __('Edit') }}
                        </x-edit-button>
                        <x-delete-button>
                            {{ __('Delete') }}
                        </x-delete-button>
                    </div>
                </div>
                @endforeach
            </div>

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
                                @endcan
                                <th scope="col" class="px-2 py-3">
                                </th>
                                <th scope="col" class="px-2 py-3">
                                </th>
                                <th scope="col" class="px-2 py-3">
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                <th scope="row"
                                    class="px-6 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->name }}
                                </th>
                                <td class="px-2 py-4">
                                    {{ $user->email }}
                                </td>
                                <td class="px-2 py-3 ">
                                    @if ($user->is_admin)
                                    <span
                                        class="bg-orange-100 text-orange-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">
                                        Admin
                                    </span>
                                    @else
                                    User
                                    @endif
                                </td>
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
                                @can('superadmin')
                                <td class="px-2 py-3" x-cloak x-data="{ showModal: false }"
                                    x-on:keydown.window.escape="showModal = false">
                                    @if ($user->is_admin)
                                    <button x-on:click="showModal = !showModal" x-cloak
                                        class="font-medium text-gray-500 dark:text-gray-400 hover:underline">
                                        Remove Admin
                                    </button>
                                    <div x-cloak x-show="showModal" x-transition.opacity
                                        class="fixed inset-0 z-50 backdrop-blur">
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
                                                <form action="{{ route('admin.users.removeadmin', $user->id) }}"
                                                    method="POST" class="inline-flex">
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
                                        class="fixed inset-0 z-50 backdrop-blur">
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
                                                <form action="{{ route('admin.users.makeadmin', $user->id) }}"
                                                    method="POST" class="inline-flex">
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
                                <td class="px-2 py-3" x-cloak x-data="{ showModal: false }"
                                    x-on:keydown.window.escape="showModal = false">
                                    @if ($user->is_verified)
                                    <button x-on:click="showModal = !showModal" x-cloak
                                        class="font-medium text-gray-500 dark:text-gray-400 hover:underline">
                                        Unverify
                                    </button>
                                    <div x-cloak x-show="showModal" x-transition.opacity
                                        class="fixed inset-0 z-50 backdrop-blur">
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
                                                <form action="{{ route('admin.users.unverify', $user->id) }}"
                                                    method="POST" class="inline-flex">
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
                                        class="fixed inset-0 z-50 backdrop-blur">
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
                                                <form action="{{ route('admin.users.verify', $user->id) }}"
                                                    method="POST" class="inline-flex">
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
                                <td class="px-2 py-3">
                                    <a href="#"
                                        class="font-medium text-gray-500 dark:text-gray-400 hover:underline">View</a>
                                </td>
                                <td class="px-2 py-3">
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                                <td class="px-2 py-3" x-cloak x-data="{ showModal: false }"
                                    x-on:keydown.window.escape="showModal = false">
                                    <button x-on:click="showModal = !showModal" x-cloak
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">
                                        Delete
                                    </button>
                                    <div x-cloak x-show="showModal" x-transition.opacity
                                        class="fixed inset-0 z-50 backdrop-blur">
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
                                                <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                    method="POST" class="inline-flex">
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
