# 👟Befit Event API👟

This API returns a list of events and linked participants. To get started follow the installation instructions below.

## Setup Instructions

1. Clone this repository `git clone https://github.com/greg162/ttt-coding-challenge.git`
2. Install the required libraries by navigating to the project folder and running `composer install`
3. Create a .env file and add your database details. *NOTE:* This setup was tested with a MySQL database.
3. Add the required tables and fields by running the database migrations `php artisan migrate`
4. Populate the database with the event and participant data. `php artisan db:seed`
5. Run the unit tests to make sure everything is setup as expected `php artisan test`
6. Go to the event API (/api/events) endpoint and check everything is working as expected.
7. Import open-api.json into Postman and begin testing!