# Shortlink Project

This is a URL shortener built with Laravel.

## Features
- Shorten long URLs
- Track URL visits
- API support

## Installation
1. Clone the repository:
   ```sh
   git clone https://github.com/your-username/your-repo.git
   cd your-repo
2. Install dependencies:
   ```sh
   composer install
3. Set up your .env file and generate an app key:
   ```sh
   cp .env.example .env
   php artisan key:generate

## Caching Configuration
- This project requires Redis for caching, session handling, and queues. If Redis is not installed or running, you can change the cache driver to database.
   .env
    CACHE_DRIVER=redis
    SESSION_DRIVER=redis
    QUEUE_CONNECTION=redis

-  Alternative: Use Database Cache If Redis Is Not Available
   by change config/cache  'default' => env('CACHE_STORE', 'redis') to 'default' => env('CACHE_STORE', 'database')

   and change .env
    CACHE_DRIVER=database
    SESSION_DRIVER=file
    QUEUE_CONNECTION=database



   
