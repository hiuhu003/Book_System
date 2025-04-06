<?php

namespace App\Providers;

use App\Policies\BookPolicy;
use App\Models\Book;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the BookPolicy for the Book model
        Gate::policy(Book::class, BookPolicy::class);
    }
}
