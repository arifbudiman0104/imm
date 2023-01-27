<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <x-button.back href="{{ route('admin.users.index') }}">
                {{ __('Back') }}
            </x-button.back>
        </x-section>
    </div>

</x-admin-layout>
