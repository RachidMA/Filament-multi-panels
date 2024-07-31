<?php

namespace App\Providers;

use App\Http\Filament\Auth\CustomLogin;
use App\Http\Middleware\EnsureUserHasAccess;
//use App\Http\Responses\LoginResponse;
//use App\Http\Responses\LogoutResponse;
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     * namespace Filament\Http\Responses\Auth;
     */
    public function boot(): void
    {
        $this->app->singleton(
            LogoutResponse::class,
            \App\Http\Responses\LogoutResponse::class
        );
        $this->app->singleton(
            LoginResponse::class,
            \App\Http\Responses\LoginResponse::class
        );
    }
}
