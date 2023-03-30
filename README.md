# Virtual Card Generator

> This is a simple project to generate virtual business cards.

## 💻 Technologies

You will need the following to run the project:
* Node 18.15.0+
* PHP 8.1+
* Composer 2
* PostgreSQL

## 🚀 Installing for local development
Follow the steps below to start developing

First, you need to clone the project
```
git clone https://github.com/jaedson-correia/virtual-card-generator.git
```

Switch to the repo folder and run
```
composer install
```

Copy .env.example to .env and configure as needed
```
cp .env.example .env
```

Generate the application key
```
php artisan key:generate
```

Run database migration
```
php artisan migrate
```

As a last step, run server locally
```
php artisan serve
```

And now you're set.
