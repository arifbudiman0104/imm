<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center mb-2 px-4 py-2 bg-sky-100 dark:bg-sky-800 rounded-md font-semibold text-xs text-sky-700 dark:text-sky-300 uppercase tracking-widest shadow-sm hover:bg-sky-200 dark:hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
