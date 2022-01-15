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
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @foreach($events as $event)
                        <div class="p-6 bg-white border-b border-gray-200" style="background-color: {{ $event['color'] }}">
                            @if($event['leftTime'])
                                <p>[{{ $event['startDate']->format('H:i') }} => {{ gmdate('H:i:s', $event['leftTime']) }} => {{ $event['endDate']->format('H:i') }}] {{ $event['name'] }}</p>
                            @else
                                <p>[{{ $event['startDate']->format('H:i') }} => {{ $event['endDate']->format('H:i') }}] {{ $event['name'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
</div>
