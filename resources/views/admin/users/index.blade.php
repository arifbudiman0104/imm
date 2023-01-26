<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        {{-- <x-section>
            <header class="">
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    All User
                </h2>
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">
                    Becareful delete action is irreversible.
                </p>
            </header>
        </x-section> --}}
        <x-section>
            <div class="mb-5">
                <x-primary-button href="">
                    {{ __('Create User') }}
                </x-primary-button>
            </div>

            <div class="xl:hidden grid grid-cols-1 lg:grid-cols-2 gap-5">
                @foreach ($users as $user)
                <div class="mb-1">
                    <div class="bg-gray-50 dark:bg-gray-700 dark:border-gray-500 rounded-lg p-5">
                        <div class="justify-between flex">
                            @if ($user->is_admin)
                            <span
                                class="bg-orange-100 text-orange-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">
                                Admin
                            </span>
                            @else
                            <span
                                class="bg-gray-200 text-gray-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300">
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
                        <div class="flex">
                            <div class="flex-grow">
                                <p class="my-2 font-bold text-gray-900 whitespace-nowrap dark:text-white"> {{
                                    $user->name }}</p>
                                <p class="font-bold"> {{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-2 mt-5 sm:justify-between">
                            <div>
                                @if ($user->is_admin)
                                <x-default-button :user="$user">
                                    {{ __('Make User') }}
                                </x-default-button>
                                @else
                                <x-make-admin-button :user="$user">
                                    {{ __('Make Admin') }}
                                </x-make-admin-button>
                                @endif
                                @if ($user->is_verified)
                                <x-default-button :user="$user">
                                    {{ __('Unverify') }}
                                </x-default-button>
                                @else
                                <x-verify-button :user="$user">
                                    {{ __('Verify') }}
                                </x-verify-button>
                                @endif
                                <x-edit-button :user="$user">
                                    {{ __('Edit') }}
                                </x-edit-button>
                            </div>
                            <div>
                                <x-delete-button :user="$user">
                                    {{ __('Delete') }}
                                </x-delete-button>
                            </div>
                        </div>
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
                                <th scope="col" class="px-6 py-3">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Verified
                                </th>
                                <th scope="col" class="px-2 py-3">
                                    Action
                                </th>
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
                            <tr class="odd:bg-white even:bg-gray-50  odd:dark:bg-gray-800 even:dark:bg-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $user->name }}
                                </th>
                                <td class="px-2 py-4">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 ">
                                    @if ($user->is_admin)
                                    <span
                                        class="bg-orange-100 text-orange-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300">
                                        Admin
                                    </span>
                                    @else
                                    User
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($user->is_verified)
                                    <span
                                        class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                        Verified
                                    </span>
                                    @else
                                    Not Verify
                                    @endif
                                </td>
                                <td class="px-2 py-4">
                                    @if ($user->is_admin)
                                    <a href="#" class="font-medium text-gray-500 dark:text-gray-400 hover:underline">
                                        Make User
                                    </a>
                                    @else
                                    <a href="#"
                                        class="font-medium text-yellow-600 dark:text-yellow-500 hover:underline">
                                        Make Admin</a>
                                    @endif
                                </td>
                                <td class="px-2 py-4">
                                    @if ($user->is_verified)
                                    <a href="#" class="font-medium text-gray-500 dark:text-gray-400 hover:underline">
                                        Unverify
                                    </a>
                                    @else
                                    <a href="#"
                                        class="font-medium text-green-600 dark:text-green-500 hover:underline">Verify</a>
                                    @endif
                                </td>
                                <td class="px-2 py-4">
                                    <a href="#"
                                        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                                <td class="px-2 py-4">
                                    <a href="#"
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>



        </x-section>
    </div>
</x-admin-layout>
