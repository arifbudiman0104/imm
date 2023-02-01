<div class="hidden xl:block">
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 pl-6">
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
                        Completed
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
                    <th scope="col" class="py-3 pl-2 pr-6">
                    </th>

                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr class="odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">

                    {{-- Name --}}
                    <th scope="row" class="py-3 pl-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->name }}
                    </th>

                    {{-- Email --}}
                    <td class="px-2 py-4">
                        {{ $user->email }}
                    </td>

                    {{-- Role --}}
                    <td class="px-2 py-3 ">
                        @if ($user->is_admin && !$user->is_superadmin)
                        <x-badge.admin />
                        @elseif ($user->is_admin && $user->is_superadmin)
                        <x-badge.superadmin />
                        @else
                        User
                        @endif
                    </td>

                    {{-- Verified --}}
                    <td class="px-2 py-3 ">
                        @if ($user->is_verified)
                        <x-badge.verified />
                        @else
                        Not Verify
                        @endif
                    </td>

                    {{-- Completed --}}
                    <td class="px-2 py-3 ">
                        @if ($user->username !== null && $user->dob !== null && $user->pob !== null && $user->gender !==
                        null && $user->phone !== null && $user->address !== null)
                        <x-badge.completed />
                        @else
                        Not Complete
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
                            class="fixed inset-0 z-50 backdrop-blur-xl bg-gray-600/30 dark:bg-gray-500/30">
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
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-orange-600 dark:text-orange-500 hover:underline">
                            Make Superadmin
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl bg-gray-600/30 dark:bg-gray-500/30">
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
                    </td>
                    <td class="px-2 py-3" x-cloak x-data="{ showModal: false }"
                        x-on:keydown.window.escape="showModal = false">
                        @if ($user->is_admin)
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-gray-500 dark:text-gray-400 hover:underline">
                            Remove Admin
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl bg-gray-600/30 dark:bg-gray-500/30">
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
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-orange-600 dark:text-orange-500 hover:underline">
                            Make Admin
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl bg-gray-600/30 dark:bg-gray-500/30">
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
                            class="fixed inset-0 z-50 backdrop-blur-xl bg-gray-600/30 dark:bg-gray-500/30">
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
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-green-600 dark:text-green-500 hover:underline">
                            Verify
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl bg-gray-600/30 dark:bg-gray-500/30">
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
                    </td>

                    {{-- Edit --}}
                    <td class="px-2 py-3">
                        <a href="#" class="font-medium text-gray-500 dark:text-gray-400 hover:underline">Edit</a>
                    </td>

                    {{-- View --}}
                    <td class="py-3 pl-2 pr-6" x-cloak x-data="{ showModal: false }"
                        x-on:keydown.window.escape="showModal = false">
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-gray-500 dark:text-gray-400 hover:underline">
                            View
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 backdrop-blur-xl bg-gray-600/30 dark:bg-gray-500/30">
                        </div>
                        <div x-cloak x-show="showModal" x-transition
                            class="fixed inset-0 z-50 flex items-center justify-center p-6">
                            <div x-on:click.away="showModal = false"
                                class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                                <div class="p-5">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ $user->name }}
                                    </h2>
                                    <div class="mb-5">
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            Username : {{ $user->username }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            Email : {{ $user->email }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            Hiden Email : {{ $user->hide_email ? 'Yes' : 'No' }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            Gender :
                                            @if ($user->gender == 'male')
                                            Male
                                            @elseif ($user->gender == 'female')
                                            Female
                                            @else
                                            Empty
                                            @endif
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            POB :
                                            @if ($user->pob)
                                            {{ $user->pob }}
                                            @else
                                            Empty
                                            @endif
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            DOB :
                                            @if ($user->dob)
                                            {{ $user->dob }}
                                            @else
                                            Empty
                                            @endif
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            Phone : @if ($user->phone)
                                            {{ $user->phone }}
                                            @else
                                            Empty
                                            @endif
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            Address : @if ($user->address)
                                            {{ $user->address }}
                                            @else
                                            Empty
                                            @endif
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            Bio : @if ($user->bio)
                                            {{ $user->bio }}
                                            @else
                                            Empty
                                            @endif
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            Verified : {{ $user->is_verified ? 'Yes' : 'No' }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            Admin : {{ $user->is_admin ? 'Yes' : 'No' }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            Superadmin : {{ $user->is_superadmin ? 'Yes' : 'No' }}
                                        </p>
                                    </div>
                                    <x-button.edit href="#">
                                        Edit
                                    </x-button.edit>
                                    <x-button.default x-on:click="showModal = false">
                                        Close (Esc)
                                    </x-button.default>
                                </div>
                            </div>
                        </div>

                    </td>

                    {{-- Delete --}}
                    <td class="py-3 pl-2 pr-6" x-cloak x-data="{ showModal: false }"
                        x-on:keydown.window.escape="showModal = false">
                        <button x-on:click="showModal = !showModal" x-cloak
                            class="font-medium text-red-600 dark:text-red-500 hover:underline">
                            Delete
                        </button>
                        <div x-cloak x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 bg-red-600/30 dark:bg-red-500/30 backdrop-blur-xl">
                        </div>
                        <div x-cloak x-show="showModal" x-transition
                            class="fixed inset-0 z-50 flex items-center justify-center p-6">
                            <div x-on:click.away="showModal = false"
                                class="w-screen max-w-xl mx-auto rounded-lg bg-gray-50 min-h-max dark:bg-gray-700">
                                <div class="p-5">
                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                        {{ __('Are you sure you want to delete this user?') }}
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

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-3 pl-6 pr-2">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            No users found.
                        </p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
