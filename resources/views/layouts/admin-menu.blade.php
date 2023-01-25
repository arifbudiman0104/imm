<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    {{-- <div class="flex items-center justify-center text-gray-800 bg-red-50 h-9 dark:bg-red-500 dark:text-gray-200">
        Admin</div> --}}
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex items-center shrink-0 sm:hidden">
                    <div class="flex items-center w-auto text-gray-800 fill-current h-9 dark:text-gray-200">Admin Menu
                    </div>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-4 sm:-my-px sm:flex">
                    <x-nav-link :href="route('admin.user.index')" :active="request()->routeIs('admin.user.index')">
                        {{ __('User') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.index')">
                        {{ __('Posts') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center -mr-2 sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.user.index')" :active="request()->routeIs('admin.user.index')">
                {{ __('User') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.index')">
                {{ __('Posts') }}
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
