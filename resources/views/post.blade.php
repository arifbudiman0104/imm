<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Post
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="gap-5 lg:flex">
                <div class="lg:w-2/3">
                    @if ($post->post_category_id != 1 || $post->is_featured == false)
                    <div class="flex justify-between mb-2">
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
                    <h2 class="text-2xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                        {{ $post->title }}
                    </h2>
                    <div class="flex flex-col justify-between my-5">
                        <div class="flex items-center gap-1 mt-1">
                            @if ($post->user->is_verified && $post->user->username != null)
                            <a href="{{route('user.page', $post->user->username)}}"
                                class="text-gray-900 text-md dark:text-gray-100">
                                {{ $post->user->name }}
                            </a>
                            <x-badge.verified />
                            @elseif ($post->user->is_verified && $post->user->username == null)
                            <p class="text-gray-900 text-md dark:text-gray-100">
                                {{ $post->user->name }}
                            </p>
                            <x-badge.verified />
                            @else
                            <p class="text-gray-900 text-md dark:text-gray-100">
                                {{ $post->user->name }}
                            </p>
                            @endif
                        </div>
                        <div class="flex gap-2 place-items-end shrink-0">
                            <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                Published {{ $post->published_at->format('d M Y') }}
                            </p>
                            <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                {{ $post->views }}
                                {{ Str::plural('view', $post->views) }}
                            </p>
                        </div>
                    </div>
                    <div class="max-w-2xl prose dark:prose-invert prose-indigo">
                        {!! $post->body !!}
                    </div>
                </div>
                <div class="mt-5 space-y-5 lg:w-1/3 lg:mt-0">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Related Post
                        </h2>
                        <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-1">
                            @foreach ($related_posts as $related_post)
                            <x-card.post-public>
                                <a href="{{ route('post', $related_post->slug) }}">
                                    <div class="flex flex-col justify-between h-full">
                                        <div class="flex flex-col">
                                            @if ($related_post->post_category_id != 1 || $related_post->is_featured ==
                                            false)
                                            <div class="flex justify-between">
                                                <div>
                                                    @if ($related_post->post_category_id != 1)
                                                    <div
                                                        class="font-medium text-indigo-600 uppercase text-md dark:text-indigo-400">
                                                        {{ $related_post->post_category->title }}
                                                    </div>
                                                    @endif
                                                </div>
                                                @if ($related_post->is_featured)
                                                <x-badge.post-featured>
                                                    Featured
                                                </x-badge.post-featured>
                                                @endif
                                            </div>
                                            @endif
                                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                                {{ $related_post->title }}
                                            </p>
                                            @if ($related_post->excerpt)
                                            <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                                {{ $related_post->excerpt }}
                                            </p>
                                            @else
                                            <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                                {{ Str::limit(strip_tags($related_post->body), 100) }}
                                            </p>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <div class="flex flex-col justify-between sm:flex-row lg:flex-col">
                                                <div class="flex items-center gap-1 mt-1">
                                                    <p class="text-gray-900 text-md dark:text-gray-100">
                                                        {{ $related_post->user->name }}
                                                    </p>
                                                    @if ($related_post->user->is_verified)
                                                    <div>
                                                        <x-badge.verified />
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="flex gap-2 place-items-end shrink-0">
                                                    <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                                        {{ $related_post->published_at->diffForHumans() }}
                                                    </p>
                                                    <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                                        {{ $related_post->views }}
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
                    </div>
                    <div class="hidden lg:block">
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Recomended Post
                        </h2>
                        <div class="grid grid-cols-1 gap-5 mt-5 md:grid-cols-2 lg:grid-cols-1 xl:grid-cols-1">
                            @foreach ($recommended_posts as $recommended_post)
                            <x-card.post-public>
                                <a href="{{ route('post', $recommended_post->slug) }}">
                                    <div class="flex flex-col justify-between h-full">
                                        <div class="flex flex-col">
                                            @if ($recommended_post->post_category_id != 1 ||
                                            $recommended_post->is_featured == false)
                                            <div class="flex justify-between">
                                                <div>
                                                    @if ($recommended_post->post_category_id != 1)
                                                    <div
                                                        class="font-medium text-indigo-600 uppercase text-md dark:text-indigo-400">
                                                        {{ $recommended_post->post_category->title }}
                                                    </div>
                                                    @endif
                                                </div>
                                                @if ($recommended_post->is_featured)
                                                <x-badge.post-featured>
                                                    Featured
                                                </x-badge.post-featured>
                                                @endif
                                            </div>
                                            @endif
                                            <p class="text-lg font-bold text-gray-900 dark:text-gray-100">
                                                {{ $recommended_post->title }}
                                            </p>
                                            @if ($recommended_post->excerpt)
                                            <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                                {{ $recommended_post->excerpt }}
                                            </p>
                                            @else
                                            <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                                {{ Str::limit(strip_tags($recommended_post->body), 100) }}
                                            </p>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <div class="flex flex-col justify-between sm:flex-row lg:flex-col">
                                                <div class="flex items-center gap-1 mt-1">
                                                    <p class="text-gray-900 text-md dark:text-gray-100">
                                                        {{ $recommended_post->user->name }}
                                                    </p>
                                                    @if ($recommended_post->user->is_verified)
                                                    <x-badge.verified />
                                                    @endif
                                                </div>
                                                <div class="flex gap-2 place-items-end shrink-0">
                                                    <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                                        {{ $recommended_post->published_at->diffForHumans() }}
                                                    </p>
                                                    <p class="mt-1 text-xs text-gray-900 dark:text-gray-100">
                                                        {{ $recommended_post->views }}
                                                        {{ Str::plural('view', $recommended_post->views) }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </x-card.post-public>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </x-section>
        {{-- Comment --}}
        <div class="mx-auto sm:mb-5 max-w-7xl">
            <div class="w-full lg:w-2/3">
                <x-section>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        Comment
                    </h2>
                    @guest
                    <p class="mt-1 text-red-600 text-md dark:text-red-400">
                        You need to login to show comment form.
                    </p>
                    @endguest
                    @auth
                    <p class="mt-1 text-gray-600 text-md dark:text-gray-400">
                        Comment as <span class="text-indigo-600 dark:text-indigo-400">{{ Auth::user()->name }}</span>.
                    </p>
                    <div class="mt-5" class="flex flex-col">
                        <form method="POST" action="{{ route('comment.store') }}">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <textarea id="message" rows="4" name="text" maxlength="255"
                                class="w-full mb-5 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                placeholder="Write your comment here" required>{{ old('text') }}</textarea>
                            <x-input-error :messages="$errors->get('text')" class="mt-2" />
                            {{-- Send Comment & Notification. --}}
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <x-button.comment class="" type="submit">
                                        Send
                                    </x-button.comment>
                                </div>

                            </div>
                        </form>
                    </div>
                    @endauth

                    <div class="flex flex-col gap-5 mt-5">
                        @forelse ($post->comments as $comment)
                        <div class="p-5 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-500">
                            <div x-data="{ showEdit: false }">
                                <div class="flex justify-between ">
                                    <div class="flex flex-row items-center gap-2">
                                        <div class="flex items-center">
                                            @if ($comment->user->is_verified && $comment->user->username != null)
                                            <a href="{{route('user.page', $comment->user->username)}}"
                                                class="text-gray-900 text-md dark:text-gray-100">
                                                {{ $comment->user->name }}
                                            </a>
                                            <div class="ml-1">
                                                <x-badge.verified />
                                            </div>
                                            @elseif ($comment->user->is_verified && $comment->user->username == null)
                                            <p class="text-gray-900 text-md dark:text-gray-100">
                                                {{ $comment->user->name }}
                                            </p>
                                            <div class="ml-1">
                                                <x-badge.verified />
                                            </div>
                                            @else
                                            <p class="text-gray-900 text-md dark:text-gray-100">
                                                {{ $comment->user->name }}
                                            </p>
                                            @endif
                                        </div>
                                        <div class="flex gap-2 place-items-end shrink-0">
                                            <p class="text-xs text-gray-500 text-md dark:text-gray-400">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </p>
                                            @unless ($comment->created_at->eq($comment->updated_at))
                                            <p class="text-xs text-gray-500 text-md dark:text-gray-400">
                                                &middot; {{
                                                __('edited')
                                                }}</small>
                                            </p>
                                            @endunless
                                        </div>
                                    </div>
                                    <x-dropdown>
                                        <x-slot name="trigger">
                                            <button
                                                class="flex items-center justify-center w-6 h-6 text-gray-400 rounded-full hover:text-gray-500 dark:hover:text-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 dark:focus:ring-indigo-600">
                                                <span class="sr-only">Open options</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                                </svg>
                                            </button>
                                        </x-slot>
                                        <x-slot name="content">
                                            @auth
                                            @if (Auth::user()->id === $comment->user->id || Auth::user()->is_admin)
                                            <x-dropdown-link href="#" x-on:click.prevent="showEdit = !showEdit"
                                                x-text="showEdit ? 'Cancel Edit' : 'Edit'">
                                                Edit
                                            </x-dropdown-link>
                                            <form method="POST" action="{{ route('comment.destroy', $comment) }}">
                                                @csrf
                                                @method('delete')
                                                <x-dropdown-link :href="route('comment.destroy', $comment)"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Delete') }}
                                                </x-dropdown-link>
                                            </form>
                                            @endif
                                            @endauth
                                            @can('admin')
                                            @if ($comment->is_spam)
                                            <form method="POST" action="{{ route('comment.markasnotspam', $comment) }}">
                                                @csrf
                                                @method('patch')
                                                <x-dropdown-link :href="route('comment.markasnotspam', $comment)"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Mark as Not Spam') }}
                                                </x-dropdown-link>
                                            </form>
                                            @endif
                                            @endcan
                                            @if ($comment->user_id != Auth::id() )
                                            <form method="POST" action="{{ route('comment.report', $comment) }}">
                                                @csrf
                                                @method('patch')
                                                <x-dropdown-link :href="route('comment.report', $comment)"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                    {{ __('Report Spam') }}
                                                </x-dropdown-link>
                                            </form>
                                            @endif
                                        </x-slot>
                                    </x-dropdown>
                                </div>
                                <p class="text-gray-900 text-md dark:text-gray-100">
                                    {{ $comment->text }}
                                </p>
                                @can('admin')
                                @if ($comment->is_spam)
                                <p class="text-xs text-red-500 text-md dark:text-red-400">
                                    {{ $comment->spam_count }} reports
                                </p>
                                @endif
                                @endcan
                                <div class="mt-5" class="flex flex-col" x-cloak x-show="showEdit">

                                    <form method="POST" action="{{ route('comment.update', $comment) }}">
                                        @csrf
                                        @method('patch')
                                        <textarea id="message" rows="4" name="text" maxlength="255"
                                            class="w-full border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                                            placeholder="Write your comment here">{{ old('text', $comment->text) }}</textarea>
                                        <x-input-error :messages="$errors->get('text')" class="mt-2" />
                                        <x-button.comment class="mt-5" type="submit">
                                            Save
                                        </x-button.comment>
                                        <x-button.default class="mt-5" x-on:click.prevent="showEdit = !showEdit">
                                            Cancel
                                        </x-button.default>
                                    </form>

                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="p-5 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-500">
                            <p class="text-gray-500 text-md dark:text-gray-400">
                                {{ __('No comments yet, be the first to comment!') }}
                            </p>
                        </div>
                        @endforelse
                    </div>
                </x-section>
            </div>
        </div>
    </div>
</x-guest-layout>
