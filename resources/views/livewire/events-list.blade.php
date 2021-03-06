<div>
    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="flex justify-center items-center">
            <div class="w-4/5 flex justify-between items-center py-6 px-4 text-center">
                <button
                    wire:click="previousDay()"

                    type="button"
                    class="bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center"
                >
                    <i class="fas fa-arrow-left"></i>
                </button>
                <span >
                    <h1 class="text-xl font-semibold text-gray-800 leading-tight">{{ Str::upper(\Carbon\Carbon::parse($today)->translatedFormat('l')) }}</h1>
                    <h2 class="text-lg font-semibold text-gray-800 leading-tight">
                        {{ $today }}
                    </h2>
                    <h3 class="text-sm font-semibold text-gray-800 leading-tight">
                        {{ __('calendar.events_count_title', ['count' => count($events)]) }}
                    </h3>
                </span>
                <button
                    wire:click="nextDay()"

                    type="button"
                    class="bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center"
                >
                    <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <main class="xl:px-0 px-6">
        <div class="py-12 flex lg:flex-row flex-col-reverse xl:w-4/5 w-full mx-auto ">
            <div class="px-2 lg:w-4/5 w-full">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach($events as $event)
                        <div
                            @if(!$event['marked'])
                                x-data="{ disabled: false, marked: false }"
                            @else
                                x-data="{ disabled: true, marked: true }"
                            @endif

                            x-bind:style="disabled && { opacity: 0.5 }"

                            id="event-{{ $event['id'] }}"
                            class="p-6 bg-white border-b-2 border-gray-200"
                            style="border-color: {{ $event['color'] }};"
                        >
                            <article class="flex flex-col sm:flex-row items-center justify-center relative">
                                <div class="flex sm:absolute sm:left-0 items-center justify-center">
                                    <div class="">{{ $event['startDate']->format('H:i') }} =></div>
                                    @if($event['leftTime'])
                                        <div class="ml-1">{{ gmdate('H:i:s', $event['leftTime']) }} =></div>
                                    @endif
                                    <div class="ml-1">{{ $event['endDate']->format('H:i') }}</div>
                                </div>
                                <div class="ml-1 text-center">{{ $event['name'] }}</div>
                                <div
                                    class="flex mt-3 sm:mt-0 sm:absolute sm:right-0 items-center justify-center"
                                    style="color: {{ $event['color'] }}"
                                >
                                    <div
                                        x-show="disabled && !marked"

                                        class="flex justify-center items-center"
                                    >
                                        <p>{{ __('calendar.event_status_updating') }}</p>
                                    </div>
                                    <button
                                        x-show="!disabled"

                                        wire:click="markEventAs('{{ $event['id'] }}', 'done')"
                                        x-on:click="disabled = true;"

                                        type="button"
                                        class="bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center"
                                    >
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button
                                        x-show="!disabled"

                                        wire:click="markEventAs('{{ $event['id'] }}', 'skipped')"
                                        x-on:click="disabled = true;"

                                        type="button"
                                        class="bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center ml-3"
                                    >
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="px-2 lg:w-1/5 w-full mb-3 lg:mb-0">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="px-4 py-5 bg-white space-y-2 sm:p-6">
                        <div class="text-base font-medium text-gray-900">{{ __('calendar.settings_label') }}</div>
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input
                                        wire:model="displayMarked"

                                        id="display_marked"
                                        name="display_marked"
                                        type="checkbox"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded"
                                    >
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="display_marked" class="font-medium text-gray-700">{{ __('calendar.hidden_label') }}</label>
                                    <p class="text-gray-500">{{ __('calendar.hidden_info') }}</p>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
