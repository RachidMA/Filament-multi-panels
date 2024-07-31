<?php

namespace App\Providers;

use Filament\Http\Responses\Auth\Contracts\LoginResponse;
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
        // dd('FROM APP SERVICE PROVIDER');
        // //REGISTER THE COSTUM LOGINRESPONSE
        // $this->app->singleton(
        //     LoginResponse::class,
        //     \App\Http\Responses\LoginResponse::class
        // );
    }
}
