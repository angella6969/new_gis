<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
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
        Validator::extend('pdf', function ($attribute, $value, $parameters, $validator) {
            // Validasi jika file adalah PDF
            return $value->getClientOriginalExtension() === 'pdf';
        });
        Paginator::useBootstrap();
    }
}
