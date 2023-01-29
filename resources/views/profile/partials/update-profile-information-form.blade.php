<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')
        <div class="flex flex-col space-y-6 md:space-y-0 md:gap-5 md:flex-row">
            <div class="w-full space-y-6">
                {{-- Name --}}
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="block w-full mt-1"
                        :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" name="username" type="text" class="block w-full mt-1"
                        :value="old('username', $user->username)" required autofocus autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('username')" />
                </div>

                {{-- Email --}}
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="block w-full mt-1"
                        :value="old('email', $user->email)" required autocomplete="email" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="mt-2 text-sm text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification"
                                class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                        @endif
                    </div>
                    @endif
                </div>
                {{-- Place of Birth --}}
                <div>
                    <x-input-label for="pob" :value="__('Place of Birth')" />
                    <x-text-input id="pob" name="pob" type="text" class="block w-full mt-1"
                        :value="old('pob', $user->pob)" required autofocus autocomplete="pob" />
                    <x-input-error class="mt-2" :messages="$errors->get('pob')" />
                </div>

                {{-- Date of Birth --}}
                <div>
                    <x-input-label for="dob" :value="__('Date of Birth')" />
                    <x-text-input id="dob" name="dob" type="date" class="block w-full mt-1"
                        :value="old('dob', $user->dob)" required autofocus autocomplete="dob" />
                    <x-input-error class="mt-2" :messages="$errors->get('dob')" />
                </div>
                {{-- Gender --}}
                <div>
                    <x-input-label for="gender" :value="__('Gender')" />
                    <x-select id="gender" name="gender" class="block w-full mt-1" required>
                        <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }} >Male</option>
                        <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }} >Female</option>
                    </x-select>
                    <x-input-error class="mt-2" :messages="$errors->get('gender')" />
                </div>
                {{-- Phone --}}
                <div>
                    <x-input-label for="phone" :value="__('Phone')" />
                    <x-text-input id="phone" name="phone" type="text" class="block w-full mt-1"
                        :value="old('phone', $user->phone)" required autofocus autocomplete="phone" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                </div>
                {{-- Address --}}
                <div>
                    <x-input-label for="address" :value="__('Address')" />
                    <textarea id="message" rows="4" name="address" type="text" maxlength="255"
                        class="w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                        placeholder="Address">{{ old('address', $user->address )}}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('address')" />
                </div>
                {{-- Bio --}}
                <div>
                    <x-input-label for="bio" :value="__('Bio (optional)')" />
                    <textarea id="message" rows="4" name="bio" type="text" maxlength="255"
                        class="w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                        placeholder="Bio">{{  old('bio', $user->bio ) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('bio')" />
                </div>
            </div>
            <div class="w-full space-y-6">

                {{-- Instagram Link --}}
                <div>
                    <x-input-label for="instagram" :value="__('Instagram Link (optional)')" />
                    <x-text-input id="instagram" name="instagram" type="text" class="block w-full mt-1"
                        :value="old('instagram', $user->instagram)" autofocus autocomplete="instagram" />
                    <x-input-error class="mt-2" :messages="$errors->get('instagram')" />
                </div>
                {{-- Facebook Link --}}
                <div>
                    <x-input-label for="facebook" :value="__('Facebook Link (optional)')" />
                    <x-text-input id="facebook" name="facebook" type="text" class="block w-full mt-1"
                        :value="old('facebook', $user->facebook)" autofocus autocomplete="facebook" />
                    <x-input-error class="mt-2" :messages="$errors->get('facebook')" />
                </div>
                {{-- Twitter Link --}}
                <div>
                    <x-input-label for="twitter" :value="__('Twitter Link (optional)')" />
                    <x-text-input id="twitter" name="twitter" type="text" class="block w-full mt-1"
                        :value="old('twitter', $user->twitter)" autofocus autocomplete="twitter" />
                    <x-input-error class="mt-2" :messages="$errors->get('twitter')" />
                </div>
                {{-- Youtube Link --}}
                <div>
                    <x-input-label for="youtube" :value="__('Youtube Link (optional)')" />
                    <x-text-input id="youtube" name="youtube" type="text" class="block w-full mt-1"
                        :value="old('youtube', $user->youtube)" autofocus autocomplete="youtube" />
                    <x-input-error class="mt-2" :messages="$errors->get('youtube')" />
                </div>
                {{-- Website Link --}}
                <div>
                    <x-input-label for="website" :value="__('Website Link (optional)')" />
                    <x-text-input id="website" name="website" type="text" class="block w-full mt-1"
                        :value="old('website', $user->website)" autofocus autocomplete="website" />
                    <x-input-error class="mt-2" :messages="$errors->get('website')" />
                </div>
            </div>
        </div>
        {{-- Button Save --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
