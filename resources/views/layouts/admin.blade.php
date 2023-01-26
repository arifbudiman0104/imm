<!DOCTYPE html>
<html x-cloak lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    x-data="{darkMode: localStorage.getItem('darkMode')|| localStorage.setItem('darkMode', 'system')}"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
    x-bind:class="{'dark': darkMode === 'dark' || (darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none !important;
        }

        @media (prefers-color-scheme: dark) {
            ::-webkit-scrollbar {
                width: 10px;
                background-color: #111827;
            }

            ::-webkit-scrollbar-thumb {
                background-color: #fecaca;
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background-color: #ef4444;
            }
        }

        @media (prefers-color-scheme: light) {
            ::-webkit-scrollbar {
                width: 10px;
                background-color: #f5f5f5;
            }

            ::-webkit-scrollbar-thumb {
                background-color: #fecaca;
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background-color: #fca5a5;
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.admin-navigation')
        {{-- @include('layouts.admin-menu') --}}

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white dark:bg-gray-800">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
