<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Register') }}
        </h2>
    </x-slot>
    <div class="w-full sm:py-12">
        <x-auth-section>
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Register is Disable.
            </p>
            <p class="mt-1 text-indigo-600 text-md dark:text-indigo-400">
                Please contact the administrator.
            </p>
            <p class="mt-5 text-gray-600 text-md dark:text-gray-400">
                Whatsapp (Text Only) : 0812-3456-7890
            </p>
        </x-auth-section>
    </div>
</x-guest-layout>
