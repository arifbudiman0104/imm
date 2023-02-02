<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Organization History') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="mb-5">
                <x-button.create href="">
                    {{ __('Create Organization History') }}
                </x-button.create>
            </div>

            <div>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                    @forelse ($organization_histories as $organization_history)
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
                                    {{ $organization_history->organization_position->name }} {{ $organization_history->organization_field->name }}
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
            </div>
        </x-section>

    </div>
</x-app-layout>
