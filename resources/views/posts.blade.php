<x-guest-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="w-full sm:py-12">
        <x-section>
            <div class="container py-10 mx-auto">
                <h1 class="text-3xl font-semibold text-center text-gray-800 capitalize lg:text-4xl dark:text-white">All
                    <span class="text-blue-500">Posts</span></h1>

                <p class="max-w-2xl mx-auto my-6 text-center text-gray-500 dark:text-gray-300">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo incidunt ex placeat modi magni quia
                    error alias, adipisci rem similique, at omnis eligendi optio eos harum.
                </p>
                <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-16 md:grid-cols-2 xl:grid-cols-2">
                    <div>
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80"
                            src="https://images.unsplash.com/photo-1624996379697-f01d168b1a52?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                            alt="">

                        <div class="mt-8">
                            <span class="text-blue-500 uppercase">category</span>

                            <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">
                                What do you want to know about UI
                            </h1>

                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam est asperiores vel, ab
                                animi
                                recusandae nulla veritatis id tempore sapiente
                            </p>

                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <a href="#"
                                        class="text-lg font-medium text-gray-700 dark:text-gray-300 hover:underline hover:text-gray-500">
                                        John snow
                                    </a>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">February 1, 2022</p>
                                </div>

                                <a href="#" class="inline-block text-blue-500 underline hover:text-blue-400">Read
                                    more</a>
                            </div>

                        </div>
                    </div>

                    <div>
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80"
                            src="https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
                            alt="">

                        <div class="mt-8">
                            <span class="text-blue-500 uppercase">category</span>

                            <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">
                                All the features you want to know</h1>

                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam est asperiores vel, ab
                                animi
                                recusandae nulla veritatis id tempore sapiente
                            </p>

                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <a href="#"
                                        class="text-lg font-medium text-gray-700 dark:text-gray-300 hover:underline hover:text-gray-500">
                                        Arthur Melo
                                    </a>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">February 6, 2022</p>
                                </div>

                                <a href="#" class="inline-block text-blue-500 underline hover:text-blue-400">Read
                                    more</a>
                            </div>

                        </div>
                    </div>

                    <div>
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80"
                            src="https://images.unsplash.com/photo-1597534458220-9fb4969f2df5?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80"
                            alt="">

                        <div class="mt-8">
                            <span class="text-blue-500 uppercase">category</span>

                            <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">
                                Which services you get from Meraki UI
                            </h1>

                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam est asperiores vel, ab
                                animi
                                recusandae nulla veritatis id tempore sapiente
                            </p>

                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <a href="#"
                                        class="text-lg font-medium text-gray-700 dark:text-gray-300 hover:underline hover:text-gray-500">
                                        Tom Hank
                                    </a>

                                    <p class="text-sm text-gray-500 dark:text-gray-400">February 19, 2022</p>
                                </div>

                                <a href="#" class="inline-block text-blue-500 underline hover:text-blue-400">Read
                                    more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </x-section>
    </div>
</x-guest-layout>
