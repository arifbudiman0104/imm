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
            <x-default-button>
                {{ __('View') }}
            </x-default-button>
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
