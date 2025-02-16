<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            /* Cegah flash putih saat reload */
            [x-cloak] { display: none !important; }
        </style>

    </head>
    <body x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      x-init="document.documentElement.classList.toggle('dark', darkMode)"
      :class="darkMode ? 'dark' : ''"
      x-cloak
      class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white">



        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>

            @endif

            <!-- Page Content -->
            <main class="bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-white">
                @yield('content')
            </main>

        </div>
    </body>
</html>
