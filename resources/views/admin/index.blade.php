<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Admin') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section-admin>
            <p class="text-lg text-gray-900 font-lg dark:text-gray-100">{{ __("Welcome to Admin page!") }}
            </p>
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                You're logged in as
                <span class="text-red-500">
                    {{Auth::user()->name }}.
                </span>
            </p>
        </x-section-admin>
        <x-section-admin>
            <p class="text-lg text-red-500 font-lg">Attention!</p>
            <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                Please be aware that this page is only accessible to users with the Admin role, and some actions are
                irreversible.
            </p>
        </x-section-admin>
        @if (Auth::user()->is_superadmin == false)
        <x-section-admin>
            <p class="text-lg text-red-500 font-lg">Attention!</p>
            <div class="flex flex-col gap-2">
                <li class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    User with
                    <x-badge.superadmin /> role
                    can do everything.
                </li>
                <li class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    User with
                    <x-badge.admin /> role
                    can only verify user with
                    <x-badge.completed /> badge.
                </li>
                <li class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Only user with
                    <x-badge.superadmin /> role
                    can only force verify user without
                    <x-badge.completed /> badge.
                </li>
                <li class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    User with <span class="inline-flex">
                        <x-badge.verified />
                    </span>
                    it means user can create post, but need user with
                    <x-badge.admin /> role to approve the post.
                </li>
                <li class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    User with
                    <x-badge.completed />
                    and
                    <span class="inline-flex">
                        <x-badge.verified />
                    </span>
                    will have user page. Like <a href="#"
                        class="text-indigo-500">http://imm.test/user/arifbudimanarrosyid</a>
                </li>
                <li class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Delete user will delete all data related to user. Like post, comment, etc.
                    <span class="text-red-600 dark:text-red-400">
                        Its not reversible.
                    </span>
                </li>
            </div>
        </x-section-admin>
        @endif

    </div>

</x-admin-layout>
