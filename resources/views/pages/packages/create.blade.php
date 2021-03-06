<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('/css/app.css', 'assets') }}">

        @livewireStyles

        @laravelPWA

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('components.navigation')

            <!-- Page Content -->
            <main>
                @livewire('packages.packages-list')
            </main>
        </div>

        @livewireScripts

        <!-- Scripts -->
        <script src="{{ mix('/js/app.js', 'assets') }}" defer></script>
    </body>
</html>
