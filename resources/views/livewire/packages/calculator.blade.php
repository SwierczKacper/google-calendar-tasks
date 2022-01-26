<div class="w-full">
    <div class="mb-4">
        <button
            wire:click="refresh()"
            type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >{{ __('calendar.button_refresh') }}</button>
        <button
            wire:click="clear()"
            type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >{{ __('calendar.button_clear') }}</button>
        <label class="mt-3 block text-gray-700 text-sm font-bold mb-2" for="calculatorStart">
            {{ __('calendar.start_time_label') }}
        </label>
        <input wire:model.debounce.1000ms="calculatorStart" type="time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="calculatorStart">
        @error('calculatorStart')
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">{{ __('calendar.error_alert') }}</strong>
                <span class="block sm:inline">{{ $message }}</span>
            </div>
        @enderror
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="packages">
            {{ __('calendar.packages_label') }}
        </label>
        @foreach($calculatorItems as $package)
            <select wire:model.debounce.1000ms="calculatorItems.{{ $loop->index }}" class="mb-3 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <option value="">{{ __('calendar.button_remove') }}</option>
                @foreach($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->name }} - {{ gmdate("H:i:s", $package->getSummaryTime() * 60) }}</option>
                @endforeach
            </select>
        @endforeach
        <button
            wire:click="addItem()"
            type="button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >{{ __('calendar.button_add') }}</button>
    </div>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="packages">
            {{ __('calendar.result_label', ['result' => $calculatorEnd]) }}
        </label>
    </div>
</div>
