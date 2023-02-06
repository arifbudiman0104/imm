<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('User Information') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section-admin>
            {{-- <div class="mb-5">
                <x-button.create href="{{ route('admin.users.create') }}" class="shrink-0">
                    {{ __('Create User') }}
                </x-button.create>
            </div> --}}
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                {{ $user->name }}
                <span class="inline-flex">
                    @if ($user->is_verified)
                    <x-badge.verified />
                    @endif
                </span>
            </h2>
            @if ($user->organization)
            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ $user->organization->name }}
            </p>
            @endif
            <div class="pb-2 overflow-x-auto sm:pb-0">
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">Email</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->email }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">Role</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        @if ($user->is_superadmin && $user->is_admin )
                        <x-badge.superadmin />
                        @elseif ($user->is_admin )
                        <x-badge.admin />
                        @else
                        {{ __('User') }}
                        @endif
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">Hidden Email</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->hide_email ? 'Yes' : 'No' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">Verified Email</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->email_verified_at ? 'Yes' : 'No' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">Gender</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->gender = 'male' ? 'Male' : 'Female' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">POB</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->pob ? $user->pob : '-' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">POB</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->dob ? $user->dob : '-' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">SID</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->sid ? $user->sid : '-' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">University</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->university ? $user->university : '-' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">Faculty</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->faculty ? $user->faculty : '-' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">Program Study</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->program_study ? $user->program_study : '-' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">Phone</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                        {{ $user->phone ? $user->phone : '-' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">Address</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ $user->address ? $user->address : '-' }}
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row sm:mb-0">
                    <div class="flex mr-2">
                        <p class="mt-1 text-sm text-gray-400 w-44 sm:text-gray-600 shrink-0 dark:text-gray-500 sm:dark:text-gray-400">Bio</p>
                        <div class="hidden sm:block">:</div>
                    </div>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ $user->bio ? $user->bio : '-' }}
                    </p>
                </div>
            </div>



            {{-- <p class="mt-1 text-sm text-gray-600 dark:text-gray-400 shrink-0">
                You're logged in as
                <span class="text-indigo-500">
                    {{ $user->name }}
                </span>
            </p> --}}
        </x-section-admin>
        <x-section-admin>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Organization Histories
            </h2>
            <div class="grid grid-cols-1 gap-5 mt-5 lg:grid-cols-2 2xl:grid-cols-3">
                @forelse ($user->organization_history as $organization_history)
                <x-card.organization-history-dashboard>
                    <div class="flex flex-col justify-between h-full">
                        <div class="flex flex-col">
                            <div class="flex justify-between gap-1 mb-2">
                                <div class="flex gap-1">
                                    @if ($organization_history->is_active)
                                    <x-badge.oh-active />
                                    @else
                                    <x-badge.oh-nonactive />
                                    @endif
                                </div>
                                <div class="flex gap-1">
                                    @if ($organization_history->is_requested)
                                    <x-badge.oh-requested />
                                    @endif
                                    @if ($organization_history->is_approved)
                                    <x-badge.oh-approved />
                                    @endif
                                </div>
                            </div>

                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                {{ $organization_history->start_year }} - {{ $organization_history->end_year }}
                            </p>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                {{ $organization_history->organization_position->name }} {{
                                $organization_history->organization_field->name }}
                            </p>
                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                {{ $organization_history->organization->name }}
                            </p>
                            {{-- @if ($post->post_category_id != 1 || $post->is_featured == false)
                            <div class="flex justify-between">
                                <div>
                                    @if ($post->post_category_id != 1)
                                    <div class="font-medium text-indigo-600 uppercase text-md dark:text-indigo-400">
                                        {{ $post->post_category->title }}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            @if ($post->excerpt)
                            <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                {{ $post->excerpt }}
                            </p>
                            @else
                            <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                {{ Str::limit(strip_tags($post->body), 100) }}
                            </p>
                            @endif --}}
                        </div>
                        <div class="flex flex-col">
                            <div class="flex flex-col justify-between sm:flex-row 2xl:flex-col">
                                <div class="flex gap-2 place-items-end shrink-0">
                                    {{-- <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                        Created {{ $post->created_at->diffForHumans() }}
                                    </p> --}}
                                    {{-- @if ($post->is_published)
                                    <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                        Published {{ $post->published_at->diffForHumans() }}
                                    </p>
                                    @endif --}}
                                </div>
                                <div class="flex gap-2 place-items-end shrink-0">
                                    {{-- <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                        {{ $post->views }}
                                        {{ Str::plural('view', $post->views) }}
                                    </p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card.organization-history-dashboard>
                @empty
                <div class="p-5 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-500">
                    <p class="text-gray-500 text-md dark:text-gray-400">
                        {{ __('No Organization History found!') }}
                    </p>
                </div>
                @endforelse
            </div>
        </x-section-admin>
        <x-section-admin>
            <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                Cadre Histories
            </h2>
        </x-section-admin>

    </div>
</x-admin-layout>
