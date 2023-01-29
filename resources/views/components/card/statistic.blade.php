<div class="p-5 rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-500">
    <div class="flex flex-col justify-between h-full">
        @if (isset($title))
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ $title }}
        </h2>
        @endif
        <p class="mt-1 text-3xl font-bold text-gray-600 dark:text-gray-400">
            <span class="text-indigo-500">
                {{ $slot }}
            </span>
        </p>

    </div>
</div>
