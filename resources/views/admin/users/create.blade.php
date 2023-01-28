<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <x-button.back href="{{ route('admin.users.index') }}" class="">
                {{ __('Back') }}
            </x-button.back>

            <form method="post" action="{{ route('admin.users.store') }}" class="mt-6 space-y-6">
                @csrf
                {{-- @method('patch') --}}
                <div class="mt-6 space-y-6">
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name')"
                            required autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="block w-full mt-1"
                            :value="old('email')" required autocomplete="email" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>
                    <div>
                        <x-input-label for="pob" :value="__('Place of Birth')" />
                        <x-text-input id="pob" name="pob" type="text" class="block w-full mt-1" :value="old('pob')"
                            required autofocus autocomplete="pob" />
                        <x-input-error class="mt-2" :messages="$errors->get('pob')" />
                    </div>
                    <div>
                        <x-input-label for="dob" :value="__('Date of Birth')" />
                        <x-text-input id="dob" name="dob" type="date" class="block w-full mt-1" :value="old('dob')"
                            required autofocus autocomplete="dob" />
                        <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                    </div>
                    <div>
                        <x-input-label for="gender" :value="__('Gender')" />
                        <select id="gender" name="gender"
                            class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                            <option value="male" {{ 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                    </div>
                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save') }}</x-primary-button>
                        @if (session('status') === 'user-created')
                        <p x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
                        @endif
                    </div>
                </div>
            </form>
        </x-section>
    </div>

</x-admin-layout>
