<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Confirm Password') }}
        </h2>
    </x-slot>
    <div class="w-full sm:py-12">
        <x-auth-section>
            <div class="max-w-lg mx-auto">
                <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('This is a secure area of the application. Please confirm your password before
                    continuing.') }}
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required
                            autocomplete="current-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-primary-button>
                            {{ __('Confirm') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </x-auth-section>
    </div>

</x-guest-layout>
