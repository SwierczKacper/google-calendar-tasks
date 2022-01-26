<div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="gap-4 grid md:grid-cols-2 sm:grid-cols-1 lg:grid-cols-3 m-5 mb-10">
            @foreach($packages as $package)
                <div class="bg-white overflow-hidden hover:bg-green-100 border border-gray-200 p-3">
                    <div class="m-2 flex justify-between text-sm">
                        <h2 class="font-bold text-lg h-2 mb-8">{{ $package->name }} ({{ gmdate("H:i:s", $package->getSummaryTime() * 60) }})</h2>
                    </div>
                    @foreach($package->items as $event)
                        <div
                            class="p-1 bg-white border-b-2 border-gray-200 flex justify-between items-center"
                        >
                            <p class="mx-3">{{ $event['name'] }}</p>
                            <p class="mx-3">{{ gmdate("H:i:s", $event['duration'] * 60) }}</p>
                        </div>
                    @endforeach
                    <div class="w-full justify-between flex mt-4">
                        <a href="{{ route('packages.show', $package) }}">
                            <button
                                type="button"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 text-sm rounded"
                            >{{ __('calendar.button_edit') }}</button>
                        </a>
                        <button
                            wire:loading.attr="disabled"
                            wire:click="duplicate({{ $package->id }})"

                            type="button"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 text-sm rounded"
                        >{{ __('calendar.button_duplicate') }}</button>
                        <button
                            wire:loading.attr="disabled"
                            wire:click="remove({{ $package->id }})"

                            type="button"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 text-sm rounded"
                        >{{ __('calendar.button_remove') }}</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
