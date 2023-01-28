<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="mb-5">
                <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
                    All Posts
                </h2>
            </div>

            <div class="mb-5">
                <x-text-input id="search" name="search" type="text" class="w-full md:w-1/2 xl:w-1/4"
                    placeholder="Search by name or email here ..." />
            </div>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 2xl:grid-cols-3">
                <x-card.post>
                    <div class="flex flex-col justify-between h-full">
                        <div class="flex flex-col">
                            <div class="flex justify-between">
                                <div class="font-medium text-indigo-600 uppercase text-md dark:text-indigo-400">
                                    Category
                                </div>
                                <x-badge.post-featured>
                                    Featured
                                </x-badge.post-featured>
                            </div>
                            <p class="mt-2 text-lg font-bold text-gray-900 dark:text-gray-100">
                                Lorem ipsum dolor sit amet.
                            </p>
                            <p class="mt-1 text-gray-500 text-md dark:text-gray-400">
                                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ducimus reprehenderit ex
                                adipisci
                                velit.
                            </p>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex justify-between">
                                <p class="mt-1 text-gray-900 text-md dark:text-gray-100">
                                    Arif Budiman Arrosyid
                                </p>
                                <p class="mt-1 text-gray-900 text-md dark:text-gray-100">
                                    February 1, 2022
                                </p>
                            </div>
                        </div>
                    </div>
                </x-card.post>




            </div>
        </x-section>

    </div>
</x-guest-layout>
