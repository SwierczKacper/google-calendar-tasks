<div>
    <!-- Page Heading -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('calendar.events_count_title', ['count' => count($events)]) }}
            </h2>
        </div>
    </header>

    <!-- Page Content -->
    <main>
        <div class="py-12 flex w-4/5 mx-auto ">
            <div class="px-2 w-4/5">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach($events as $event)
                        <div class="p-6 bg-white border-b-2 border-gray-200" style="border-color: {{ $event['color'] }}; opacity: {{ !$event['marked'] ? 1 : 0.5 }}">
                            <article class="event">
                                <div class="event__date">
                                    <div class="date__start">{{ $event['startDate']->format('H:i') }} =></div>
                                    @if($event['leftTime'])
                                        <div class="date__left ml-1">{{ gmdate('H:i:s', $event['leftTime']) }} =></div>
                                    @endif
                                    <div class="date__end ml-1">{{ $event['endDate']->format('H:i') }}</div>
                                </div>
                                <div class="event__name ml-1">{{ $event['name'] }}</div>
                                @if(!$event['marked'])
                                    <div class="event__actions" style="color: {{ $event['color'] }}">
                                        <button
                                            wire:click="markEventAsgit('{{ $event['id'] }}', 'done')"

                                            type="button"
                                            class="bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center"
                                        >
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button
                                            wire:click="markEventAs('{{ $event['id'] }}', 'skipped')"

                                            type="button"
                                            class="bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center ml-3"
                                        >
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                @endif
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="px-2 w-1/5">
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
