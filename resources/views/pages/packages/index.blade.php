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

        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('components.navigation')

            <!-- Page Content -->
            <main>
                <!-- Page Heading -->
                <header class="bg-white shadow">
                    <div class="flex justify-center items-center">
                        <div class="w-4/5 flex justify-between items-center py-6 px-4 text-center">
                            <span>
                                <h1 class="text-xl font-semibold text-gray-800 leading-tight">{{ __('calendar.packages_label') }}</h1>
                            </span>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="xl:px-0 px-6">
                    <div class="py-12 flex lg:flex-row flex-col-reverse xl:w-4/5 w-full mx-auto">
                        <div class="px-2 lg:w-4/5 w-full">
                            @livewire('packages.packages-list')
                        </div>
                        <div class="px-2 lg:w-1/5 w-full mb-3 lg:mb-0">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="px-4 py-5 bg-white space-y-2 sm:p-6">
                                    <div class="text-base font-medium text-gray-900">{{ __('calendar.settings_label') }}</div>
                                    <div class="flex items-start">
                                        <div
                                            x-data="{ }"
                                            x-on:livewire-close-create-package-modal="document.querySelector('#createPackageModalButton').click();"
                                        >
                                            <button class="block w-full md:w-auto text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button" data-modal-toggle="extralarge-modal">
                                                {{ __('calendar.button_create') }}
                                            </button>

                                            @livewire('packages.create-package')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="px-4 py-5 bg-white space-y-2 sm:p-6">
                                    <div class="text-base font-medium text-gray-900">{{ __('calendar.calculator_label') }}</div>
                                    <div class="flex items-start">
                                        @livewire('packages.calculator')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </main>
        </div>

        @livewireScripts

        <!-- Scripts -->
        <script src="{{ mix('/js/app.js', 'assets') }}" defer></script>
    </body>
</html>
