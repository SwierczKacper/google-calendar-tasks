<?php

return [
    /*
     *  Service account json
     */
    'service_account_json' => storage_path('app/google-calendar/service-account-credentials.json'),

    /*
     *  The id of the Google Calendar that will be used by default.
     */
    'calendar_id' => env('GOOGLE_CALENDAR_ID'),

    /**
     * Google calendar colors
     */
    'colors' => ['#039be5','#7986cb','#33b679','#8e24aa','#e67c73','#f6c026','#f5511d','#039be5','#616161','#3f51b5','#0b8043','#d60000'],
];
