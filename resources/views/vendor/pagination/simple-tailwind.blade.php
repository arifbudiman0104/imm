@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <span
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-200 bg-gray-100 rounded-md cursor-default dark:text-gray-600 dark:bg-gray-700">
        {!! __('pagination.previous') !!}
    </span>
    @else
    <a href="{{ $paginator->previousPageUrl() }}"
        class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-gray-100 rounded-md dark:text-gray-200 dark:bg-gray-700 hover:text-gray-500 focus:outline-none active:bg-gray-100 active:text-gray-700">
        {!! __('pagination.previous') !!}
    </a>
    @endif

    @if ($paginator->hasMorePages())
    <a href="{{ $paginator->nextPageUrl() }}"
        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-700 transition duration-150 ease-in-out bg-gray-100 rounded-md dark:text-gray-200 dark:bg-gray-700 hover:text-gray-500 focus:outline-none active:bg-gray-100 active:text-gray-700">
        {!! __('pagination.next') !!}
    </a>
    @else
    <span
        class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium leading-5 text-gray-200 bg-gray-100 rounded-md cursor-default dark:text-gray-600 dark:bg-gray-700">
        {!! __('pagination.next') !!}
    </span>
    @endif
</nav>
@endif
