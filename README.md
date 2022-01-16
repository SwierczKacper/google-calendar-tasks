### Introduction
Google Calendar App offers "Goals" feature where you can set your custom goal and mark them as "done" by tapping on them.

<img src="https://user-images.githubusercontent.com/49414354/149644387-99989c5c-2a87-4b55-879d-3a4920f77750.png" style="width:300px">

Using "Goals" we don't have ability to choose exact time when goal should appear (I cannot set goal every day at 9am), we can only select morning / afternoon / evening or on any time.

<img src="https://user-images.githubusercontent.com/49414354/149644471-892cb32f-afa6-48bb-8831-fe6203e788ed.png" style="width:300px">

As a cause of that, goal will appear at a random time in the morning / afternoon / evening or any time during the day.

After creating "Goal" with this method, we can drag it to specific time but this would costs us effort if we have multiple goals per day and we could do it endless.

The solution for that problem could be normal events where we can set specific start time, end time and repeat frequency, but this solution also have one big defect, we cannot mark that event as done just like we can do it in goals.

### Conclusion
The solution for this problem is this app which is facade for Google Calendar. It grabs all events for specific day from Google Calendar and let us easily mark them as done by adding suffix "- Done" (or another). Also we have information about start, end time and time left to end if during progress.

One of the best feature of this app is "Packages" for specific days.
###### After some time of using this app (I have used older version of this facade from january 2021 until release this version) I faced big problem with adding new events between existing ones or reordering existing ones, it takes me a lot of time (in extreme cases about 4 hours).

Packages are solution for this problem, we can set one package with 30 events in specific order and use this packages on different days started on different time.
Then we can easily reorder events or add new events in package and system automatically will reorder and start time of other events

### Installation
1. composer install
2. composer update
3. npm install
4. npm run dev
5. Copy .env.example to .env
6. php artisan key:generate
7. php artisan storage:link
8. Update .env file:
- APP_NAME=
- APP_URL=http://localhost
- ASSET_URL=http://localhost
- APP_DOMAIN=
- COOKIE_DOMAIN=
- SESSION_DOMAIN=
- DEBUGBAR_ENABLED=false
- REGISTRATION_ENABLED=false
- GOOGLE_CALENDAR_ID=(google email)
- APP_TIMEZONE="Europe/Warsaw"
- APP_LOCALE=pl
- APP_FALLBACK_LOCALE=pl
- MySQL Credentials
9. php artisan migrate
10. Put in /storage/app/google-calendar/ credentials json (i preffer service-account-credentials.json), look at: https://github.com/spatie/laravel-google-calendar#installation

### Trello
Tasks list: https://trello.com/b/CcDx3qCO/google-calendar-tasks
