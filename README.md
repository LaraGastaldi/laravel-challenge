# Laravel challenge

## Requirements

- NPM
- PHP 7.3
- MySQL or other local database

## Installation

Configure a local database and schema and make the appropriate changes in the .env file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=challengedev
DB_USERNAME=root
DB_PASSWORD=root

<hr>

Download the source code.

Run `npm install` inside the project's directory.

Run `php artisan migrate` to make the changes in the database.

<hr>

Run `php artisan serve` inside the directory to run the server.

And if no errors occur, there you have it on port 8000!

![image](https://user-images.githubusercontent.com/32528713/148267587-07f91a07-dd10-488c-a6ed-2c3144078d65.png)

The users list will be empty, since your database is empty.
Every time you remove or edit an user, refresh the page either with the navigator's refresh button or the page's.
