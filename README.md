# Hiretop Backend
This project was generated with laravel version 9.52.16 with php 8.0.2

## Install composer
Install composer `2.6.3`

## Install project
Run `composer i` for install project with composer.

## Env
Duplicate file .env.example and rename to .env

## Database in file .env

`DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=hiretop
DB_USERNAME=root
DB_PASSWORD=password`



## Mail in file .env

`MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=3c5250417e2bd0
MAIL_PASSWORD=6983393eb4d270
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"`

## Migration 

Run `php artisan migrate` to migrate databse

## Seeder 

Run `php artisan db:seed` to migrate database

## Import table countries with data 

Import the sql files (in the order countries.sql, states.sql, cities.sql) located in the import-sql folder in the project source into your database.


## Passport keys
Run `php artisan passport:install` to migrate database
In the terminal two keys will be generated, please use the key "Password grant client created successfully" in the frontend.

## Run project
Run `php artisan serve`

### Thanks






