<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Todo;
use App\Policies\TodoPolicy;
use Illuminate\Support\Facades\URL;

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
        // Register TodoPolicy
        Gate::policy(Todo::class, TodoPolicy::class);

        if(config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}