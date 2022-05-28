# Laravel Mongez MongoDB

This is a repository for quick start projects using [Laravel](https://laravel.com/), [Mongez](https://github.com/hassanzohdy/mongez) And [MongoDB](https://github.com/jenssegers/laravel-mongodb)

## Current Versioning

-   Laravel: 9.x
-   Mongez: 2.x
-   jenssegers/mongodb: 3.9

## Installation

Clone this repository then navigate to the project directory and run the following command.

```
composer install
```

Next Generate Application Key

```
php artisan key:generate
```

## Predefined Modules

Only the Users module is added this repository alongside with Guests module, so access tokens can be generated for guests and users.

## Working With Sanctum And Middleware

The project authentication is based on [Laravel Sanctum](https://laravel.com/docs/9.x/sanctum).

To allow Certain type of users to access routes/groups...etc, use `auth:userType` as middleware.

For instance, if request is available for guest users only i.e login/register routes add `auth:guest` middleware.

If allowed for customers/users use the same type located in `config/auth.php` under `guards` key.

You may also assign multiple guards per middleware by adding comma between each guard, i.e `auth:guest,user,customer`
