<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Organization History') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">

        <x-section-admin>
            <header>
                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                    {{ __('Edit Organization History') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    {{ __("Please fill in the form below to edit an organization history and contact admin to
                    approve it.") }}
                </p>
            </header>

            <form action="{{ route('admin.organization-histories.update', $organization_history->id)}}"
                method="post" class="mt-6 space-y-6">
                @csrf
                @method('put')
                <div class="flex flex-col space-y-6 md:space-y-0 md:gap-5 md:flex-row">
                    <div class="w-full space-y-6">
                        <div>
                            <x-input-label for="organization_id" :value="__('Organization')" />
                            <x-select id="organization_id" name="organization_id" class="block w-full mt-1">
                                <option value="">Select Organization</option>
                                @foreach ($organizations as $organization)
                                <option value="{{ $organization->id }}" {{ $organization_history->
                                    organization_id==$organization->id ? 'selected' : '' }}>
                                    {{ $organization->name }}
                                </option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('organization_id')" />
                        </div>
                        <div>
                            <x-input-label for="organization_position_id" :value="__('Organization Position')" />
                            <x-select id="organization_position_id" name="organization_position_id"
                                class="block w-full mt-1">
                                <option value="">Select Organization Position</option>
                                @foreach ($organization_positions as $organization_position)
                                <option value="{{ $organization_position->id }}" {{ $organization_history->
                                    organization_position_id==$organization_position->id ? 'selected' : '' }}>
                                    {{ $organization_position->name }}
                                </option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('organization_position_id')" />
                        </div>
                        <div>
                            <x-input-label for="organization_field_id" :value="__('Organization Field')" />
                            <x-select id="organization_field_id" name="organization_field_id" class="block w-full mt-1">
                                <option value="">Select Organization Field</option>
                                @foreach ($organization_fields as $organization_field)
                                <option value="{{ $organization_field->id }}" {{ $organization_history->
                                    organization_field_id==$organization_field->id ? 'selected' : '' }}>
                                    {{ $organization_field->name }}
                                </option>
                                @endforeach
                            </x-select>
                            <x-input-error class="mt-2" :messages="$errors->get('organization_field_id')" />
                        </div>
                    </div>
                    <div class="w-full space-y-6">
                        <div>
                            <x-input-label for="start_year" :value="__('Start Year')" />
                            <x-text-input id="start_year" name="start_year" type="number" class="block w-full mt-1"
                                :value="old('start_year', $organization_history->start_year)" autofocus
                                autocomplete="start_year" placeholder="2018" />
                            <x-input-error class="mt-2" :messages="$errors->get('start_year')" />
                        </div>
                        <div>
                            <x-input-label for="end_year" :value="__('End Year')" />
                            <x-text-input id="end_year" name="end_year" type="number" class="block w-full mt-1"
                                :value="old('end_year', $organization_history->end_year)" autofocus
                                autocomplete="end_year" placeholder="2019" />
                            <x-input-error class="mt-2" :messages="$errors->get('end_year')" />
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
