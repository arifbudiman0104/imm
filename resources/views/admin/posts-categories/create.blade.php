<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Create Post Categories') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section-admin>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Posts Categories
            </h2>
            {{-- <div class="mb-5">
                <x-button.create href="{{ route('admin.organization-histories.create') }}">
                    {{ __('Create') }}
                </x-button.create>
            </div> --}}
            <form action="{{ route('admin.post-categories.store') }}" method="post" class="space-y-6">
                @csrf
                @method('post')
                <div class="flex flex-col space-y-6 md:space-y-0 md:gap-5 md:flex-row">
                    <div class="w-full lg:w-1/2 space-y-6">
                        <div>
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="block w-full mt-1"
                                :value="old('title')" autofocus autocomplete="title" placeholder="Category Title" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>
                        <div>
                            <x-input-label for="slug" :value="__('Slug')" />
                            <x-text-input id="slug" name="slug" type="text" class="block w-full mt-1"
                                :value="old('slug')" autofocus autocomplete="slug" placeholder="slug" />
                            <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                        </div>
                        <div>
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" name="description" type="text" class="block w-full mt-1"
                                :value="old('description')" autofocus autocomplete="description" placeholder="Description" />
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                </div>
            </form>



        </x-section-admin>
    </div>
</x-admin-layout>
