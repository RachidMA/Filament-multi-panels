<?php

namespace App\Providers;

use App\Http\Controllers\Auth\CustomLoginController;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;


//====CAN BE REMOVED TOO================
class FilamentCustomServiceProvider extends ServiceProvider
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
     */
    public function boot(): void
    {
    }
}
