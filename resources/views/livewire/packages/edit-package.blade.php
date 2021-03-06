<div>
    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="flex justify-center items-center">
            <div class="w-4/5 flex justify-between items-center py-6 px-4 text-center">
                <span>
                    <h1 class="text-xl font-semibold text-gray-800 leading-tight">{{ __('calendar.packages_edit_package_label', ['package' => $name . ' (' . gmdate("H:i:s", $summaryTime * 60) . ')']) }}</h1>
                </span>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="xl:px-0 px-6">
        <div
            wire:loading.class.remove="hidden sm:hidden md:hidden lg:hidden xl:hidden"
            class="py-12 flex lg:flex-row flex-col-reverse xl:w-4/5 w-full mx-auto hidden sm:hidden md:hidden lg:hidden xl:hidden"
        >
            <div class="px-2 w-full">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 bg-white space-y-2 sm:p-6">
                        <div class="text-base font-medium text-gray-900">{{ __('calendar.loading') }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div
            wire:loading.class="hidden sm:hidden md:hidden lg:hidden xl:hidden"
            class="py-12 flex lg:flex-row flex-col-reverse xl:w-4/5 w-full mx-auto "
        >
            <div class="px-2 lg:w-4/5 w-full">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 bg-white space-y-2 sm:p-6">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                {{ __('calendar.name_label') }}
                            </label>
                            <input
                                wire:model.debounce.1000ms="name"
                                x-bind:disabled="!edit"

                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="name"
                                type="text"
                                placeholder="{{ __('calendar.name_label') }}"
                            >
                            @error('name')
                                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                    <strong class="font-bold">{{ __('calendar.error_alert') }}</strong>
                                    <span class="block sm:inline">{{ $message }}</span>
                                </div>
                            @enderror
                        </div>
                        @foreach($items as $event)
                            <div
                                x-show="edit"
                                class="p-6 bg-white border-b-2 border-gray-200"
                            >
                                <article class="flex flex-col sm:flex-row items-center justify-center relative">
                                    <div class="flex mb-3 sm:mb-0 sm:absolute sm:left-0 items-center justify-center">
                                        <div class="mt-0 mr-0 sm:mr-3 sm:mt-6">
                                            <button
                                                wire:click="moveItem('{{ $loop->index }}', -1)"

                                                type="button"
                                                class="bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center"
                                            >
                                                <i class="fas fa-arrow-up"></i>
                                            </button>
                                            <button
                                                wire:click="moveItem('{{ $loop->index }}', 1)"

                                                type="button"
                                                class="bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center"
                                            >
                                                <i class="fas fa-arrow-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="w-full sm:w-4/5 text-center ml-1 flex flex-col sm:flex-row justify-center items-center">
                                        <div class="w-full mb-3 sm:mb-0">
                                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('calendar.name_label') }}</label>
                                            <input wire:model.debounce.1000ms="items.{{ $loop->index }}.name" class="mr-3 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" min="0" placeholder="{{ __('calendar.name_label') }}" id="{{ Str::random(6) }}">
                                        </div>
                                        <span class="hidden sm:block ml-3 mt-6">-</span>
                                        <div class="w-full">
                                            <label for="duration" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('calendar.duration_count_label', ['duration' => '(' . gmdate("H:i:s", $event['duration'] * 60) . ')']) }}</label>
                                            <input wire:model.debounce.1000ms="items.{{ $loop->index }}.duration" class="sm:ml-3 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" min="0" id="{{ Str::random(6) }}">
                                        </div>
                                    </div>
                                    <div class="flex mt-6 sm:mt-0 sm:absolute sm:right-0 items-center justify-center">
                                        <button
                                            wire:click="removeItem('{{ $loop->index }}')"

                                            type="button"
                                            class="mt-0 mr-0 sm:ml-3 sm:mt-6 bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                        <button
                            wire:click="save()"
                            type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >{{ __('calendar.button_save') }}</button>
                    </div>
                </div>
            </div>
            <div class="px-2 lg:w-1/5 w-full mb-3 lg:mb-0">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 bg-white space-y-2 sm:p-6">
                        <div class="text-base font-medium text-gray-900">{{ __('calendar.packages_add_new_item_label') }}</div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                    {{ __('calendar.name_label') }}
                                </label>
                                <input wire:model.debounce.1000ms="newItem.name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="{{ __('calendar.name_label') }}">
                                @error('newItem.name')
                                    <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                        <strong class="font-bold">{{ __('calendar.error_alert') }}</strong>
                                        <span class="block sm:inline">{{ $message }}</span>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="duration">
                                    {{ __('calendar.duration_minutes_label') }}
                                </label>
                                <input wire:model.debounce.1000ms="newItem.duration" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="duration" type="number" min="0" placeholder="{{ __('calendar.duration_label') }}">
                                @error('newItem.duration')
                                <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                    <strong class="font-bold">{{ __('calendar.error_alert') }}</strong>
                                    <span class="block sm:inline">{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <button
                                wire:click="addNewItem()"
                                type="button"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >{{ __('calendar.button_create') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
