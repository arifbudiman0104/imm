<x-guest-layout>
    {{-- <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('User') }}
        </h2>
    </x-slot> --}}

    <div class="w-full sm:py-12">
        <x-section>
            <div class="flex items-center">
                <div class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    {{ $user->name }}
                </div>
                <span class="ml-2">
                    <x-badge.verified />
                </span>
            </div>
            @if ($organizationHistoriesActive->count() > 0)
            <div>
                <ol>
                    @foreach ($organizationHistoriesActive as $organizationHistory)
                    <li>
                        <p class="text-gray-800 dark:text-gray-200 text-md">
                            {{ $organizationHistory->organization_position->name }}
                            {{ $organizationHistory->organization->name }}
                            {{ $organizationHistory->start_year }} -
                            {{ $organizationHistory->end_year }}
                        </p>
                    </li>
                    @endforeach

                </ol>
            </div>
            @endif
            @if ($organizationHistoriesNotActive->count() > 0)
            <div>
                <ol>
                    @foreach ($organizationHistoriesNotActive as $organizationHistory)
                    <li>
                        <p class="text-gray-500 text-md dark:text-gray-400">
                            {{ $organizationHistory->organization_position->name }}
                            {{ $organizationHistory->organization->name }}
                            {{ $organizationHistory->start_year }} -
                            {{ $organizationHistory->end_year }}
                        </p>
                    </li>
                    @endforeach

                </ol>
            </div>
            @endif
            <div>
                @if ($user->hide_email == false)
                {{ $user->email }}
                @endif
            </div>
            <div class="mt-2">
                @if ($user->sid)
                <p class="text-gray-500 text-md dark:text-gray-400">
                    {{ $user->sid }}
                </p>
                @endif
                @if ($user->program_study)
                <p class="text-gray-500 text-md dark:text-gray-400">
                    {{ $user->program_study }}
                </p>
                @endif
                @if ($user->faculty)
                <p class="text-gray-500 text-md dark:text-gray-400">
                    {{ $user->faculty }}
                </p>
                @endif
                @if ($user->university)
                <p class="text-gray-500 text-md dark:text-gray-400">
                    {{ $user->university }}
                </p>
                @endif
                @if ($user->bio)
                <p class="max-w-lg text-gray-500 text-md dark:text-gray-400">
                    {{ $user->bio }}
                </p>
                @endif
            </div>
            <div class="gap-2 mt-5 space-y-2">
                @if ($user->instagram)
                <x-social.instagram href="{{ $user->instagram }}" target="_blank" />
                @endif
                @if ($user->facebook)
                <x-social.facebook href="{{ $user->facebook }}" target="_blank" />
                @endif
                @if ($user->twitter)
                <x-social.twitter href="{{ $user->twitter }}" target="_blank" />
                @endif
                @if ($user->youtube)
                <x-social.youtube href="{{ $user->youtube }}" target="_blank" />
                @endif
                @if ($user->website)
                <x-social.website href="{{ $user->website }}" target="_blank" />
                @endif
            </div>



        </x-section>
        @if ($posts->count() > 0)
        <x-section>
            <div class="mb-5">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    Posted by {{ $user->name }}
                </h2>
            </div>
            {{-- <div class="mb-5">
                <x-text-input id="search" name="search" type="text" class="w-full md:w-1/2 xl:w-1/4"
                    placeholder="Search by name or email here ..." />
            </div> --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:grid-cols-3">
                @foreach ($posts as $post)
                <x-card.post-public>
                    <a href="{{ route('post', $post->slug) }}">
                        <div class="flex flex-col justify-between h-full">
                            <div class="flex flex-col">
                                @if ($post->post_category_id != 1 || $post->is_featured == false)
                                <div class="flex justify-between">
                                    <div>
                                        @if ($post->post_category_id != 1)
                                        <div class="font-medium text-indigo-600 uppercase text-md dark:text-indigo-400">
                                            {{ $post->post_category->title }}
                                        </div>
                                        @endif
                                    </div>
                                    @if ($post->is_featured)
                                    <x-badge.post-featured>
                                        Featured
                                    </x-badge.post-featured>
                                    @endif
                                </div>
                                @endif
                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                    {{ $post->title }}
                                </p>
                                @if ($post->excerpt)
                                <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                    {{ $post->excerpt }}
                                </p>
                                @else
                                <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                    {{ Str::limit(strip_tags($post->body), 100) }}
                                </p>
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <div class="flex flex-col justify-between sm:flex-row 2xl:flex-col">
                                    <div class="flex items-center gap-1 mt-1">
                                        <p class="text-gray-900 text-md dark:text-gray-100">
                                            {{ $post->user->name }}
                                        </p>
                                        @if ($post->user->is_verified)
                                        <x-badge.verified />
                                        @endif
                                    </div>
                                    <div class="flex gap-2 place-items-end shrink-0">
                                        <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                            {{ $post->published_at->diffForHumans() }}
                                        </p>
                                        <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                            {{ $post->views }}
                                            {{ Str::plural('view', $post->views) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                </x-card.post-public>
                @endforeach
            </div>
        </x-section>
        @endif
        @if ($posts->hasPages())
        <x-section>
            {{ $posts->links() }}
        </x-section>
        @endif
        {{-- <x-section>
            <div class="mb-5">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    All Posts
                </h2>
            </div>
            <div class="mb-5">
                <x-text-input id="search" name="search" type="text" class="w-full md:w-1/2 xl:w-1/4"
                    placeholder="Search by name or email here ..." />
            </div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 2xl:grid-cols-3">
                @foreach ($posts as $post)
                <x-card.post-public>
                    <a href="{{ route('post', $post->slug) }}">
                        <div class="flex flex-col justify-between h-full">
                            <div class="flex flex-col">
                                @if ($post->post_category_id != 1 || $post->is_featured == false)
                                <div class="flex justify-between">
                                    <div>
                                        @if ($post->post_category_id != 1)
                                        <div class="font-medium text-indigo-600 uppercase text-md dark:text-indigo-400">
                                            {{ $post->post_category->title }}
                                        </div>
                                        @endif
                                    </div>
                                    @if ($post->is_featured)
                                    <x-badge.post-featured>
                                        Featured
                                    </x-badge.post-featured>
                                    @endif
                                </div>
                                @endif
                                <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                    {{ $post->title }}
                                </p>
                                @if ($post->excerpt)
                                <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                    {{ $post->excerpt }}
                                </p>
                                @else
                                <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                    {{ Str::limit(strip_tags($post->body), 100) }}
                                </p>
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <div class="flex flex-col justify-between sm:flex-row 2xl:flex-col">
                                    <div class="flex items-center gap-1 mt-1">
                                        <p class="text-gray-900 text-md dark:text-gray-100">
                                            {{ $post->user->name }}
                                        </p>
                                        @if ($post->user->is_verified)
                                        <x-badge.verified />
                                        @endif
                                    </div>
                                    <div class="flex gap-2 place-items-end shrink-0">
                                        <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                            {{ $post->published_at->diffForHumans() }}
                                        </p>
                                        <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                            {{ $post->views }}
                                            {{ Str::plural('view', $post->views) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                </x-card.post-public>
                @endforeach
            </div>
        </x-section>
        @if ($posts->hasPages())
        <x-section>
            {{ $posts->links() }}
        </x-section>
        @endif --}}

    </div>
</x-guest-layout>
