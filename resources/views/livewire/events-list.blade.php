<div wire:poll.keep-alive.1s>
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
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach($events as $event)
                        <div class="p-6 bg-white border-b-2 border-gray-200" style="border-color: {{ $event['color'] }}">
                            <article class="event">
                                <div class="event__date">
                                    <div class="date__start">{{ $event['startDate']->format('H:i') }} =></div>
                                    @if($event['leftTime'])
                                        <div class="date__left ml-1">{{ gmdate('H:i:s', $event['leftTime']) }} =></div>
                                    @endif
                                    <div class="date__end ml-1">{{ $event['endDate']->format('H:i') }}</div>
                                </div>
                                <div class="event__name ml-1">{{ $event['name'] }}</div>
                                <div class="event__actions" style="color: {{ $event['color'] }}">
                                    <button
                                        wire:click="markAsDone('{{ $event['id'] }}')"

                                        type="button"
                                        class="bg-white-700 font-medium rounded-lg text-xl text-center inline-flex items-center"
                                    >
                                        <i class="fas fa-check"></i>
                                    </button>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</div>
