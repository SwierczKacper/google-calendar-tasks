<div>
    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="flex justify-center items-center">
            <div class="w-4/5 flex justify-center items-center py-6 px-4 text-center">
                <span>
                    @if($day_date != '')
                        <h1 class="text-xl text-center font-semibold text-gray-800 leading-tight">{{ Str::upper(\Carbon\Carbon::parse($day_date)->translatedFormat('l')) }}</h1>
                        <h2 class="text-lg text-center font-semibold text-gray-800 leading-tight">
                            {{ $day_date }}
                        </h2>
                    @else
                        <h1 class="text-xl text-center font-semibold text-gray-800 leading-tight">{{ __('calendar.need_to_choose_day_label') }}</h1>
                    @endif
                </span>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <div
            wire:loading.class.remove="hidden"
            class="py-12 flex w-4/5 mx-auto hidden"
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
            wire:loading.class="hidden"
            class="py-12 flex w-4/5 mx-auto "
        >
            <div class="px-2 w-4/5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 bg-white space-y-2 sm:p-6">
                        <div class="text-base font-medium text-gray-900">{{ __('calendar.packages_apply_preview_day') }}</div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="day_date">
                                {{ __('calendar.date_label') }}
                            </label>
                            <input wire:model.debounce.1000ms="day_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date" type="date">
                            @error('day_date')
                            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">{{ __('calendar.error_alert') }}</strong>
                                <span class="block sm:inline">{{ $message }}</span>
                                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                        </span>
                            </div>
                            @enderror
                        </div>
                        @foreach($events as $event)
                            <div
                                id="event-{{ $event['id'] }}"
                                class="p-6 bg-white border-b-2 border-gray-200"
                                style="border-color: {{ $event['color'] }};"
                            >
                                <article class="event">
                                    <div class="event__left">
                                        <div class="date__start">{{ $event['startDate']->format('H:i') }} =></div>
                                        <div class="date__end ml-1">{{ $event['endDate']->format('H:i') }}</div>
                                    </div>
                                    <div class="event__name ml-1">{{ $event['name'] }}</div>
                                    <div
                                        class="event__right  flex justify-center items-center" style="margin-top: 20px;"
                                    >
                                        <button
                                            wire:click="removeEvent('{{ $event['recurringEventId'] }}')"

                                            type="button"
                                            class="bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center ml-3"
                                        >
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                        @if($day_date == '')
                            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ __('calendar.need_to_choose_day_label') }}</span>
                            </div>
                        @endif
                        @if($events->isEmpty() && $day_date != '')
                            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <span class="block sm:inline">{{ __('calendar.no_events_label') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="px-2 w-1/5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 bg-white space-y-2 sm:p-6">
                        <div class="text-base font-medium text-gray-900">{{ __('calendar.button_refresh') }}</div>
                        <button
                            wire:click="cacheClear()"
                            type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >{{ __('calendar.button_refresh') }}</button>
                    </div>
                </div>
                <div class="mt-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 bg-white space-y-2 sm:p-6">
                        <div class="text-base font-medium text-gray-900">{{ __('calendar.packages_apply_remove_all_events') }}</div>
                        <button
                            wire:click="clearAll()"
                            type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >{{ __('calendar.button_clear') }}</button>
                    </div>
                </div>
                <div class="mt-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 bg-white space-y-2 sm:p-6">
                        <div class="text-base font-medium text-gray-900">{{ __('calendar.packages_apply_package') }}</div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="package_id">
                                Package
                            </label>
                            <select wire:model.debounce.1000ms="package_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="package_id">
                                <option value="">{{ __('calendar.none_label') }}</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }}</option>
                                @endforeach
                            </select>
                            @error('apply_time')
                            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">{{ __('calendar.error_alert') }}</strong>
                                <span class="block sm:inline">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="apply_time">
                                {{ __('calendar.time_label') }}
                            </label>
                            <input wire:model.debounce.1000ms="apply_time" type="time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="apply_time">
                            @error('apply_time')
                            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">{{ __('calendar.error_alert') }}</strong>
                                <span class="block sm:inline">{{ $message }}</span>
                            </div>
                            @enderror
                        </div>
                        <button
                            wire:click="applyPackage()"
                            type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >{{ __('calendar.button_apply') }}</button>
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
</div>
