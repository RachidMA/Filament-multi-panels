<?php

namespace App\Providers\Filament;

use App\Filament\Resources\UserResource;
use App\Http\Middleware\SetSessionBasedOnCompany;
use App\Http\Middleware\UserCanAccessHeadquaterPanel;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class HeadquaterPanelProvider extends PanelProvider
{

    public function panel(Panel $panel): Panel
    {
        return $panel

            ->id('headquater')
            ->path('headquater')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,


            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                SetSessionBasedOnCompany::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,

                //MAKE USER USER CAN ACCESS PANEL
                UserCanAccessHeadquaterPanel::class,
                //CREATE SESSION BASED ON COMPANY ID 
                //SetSessionBasedOnCompany::class
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    public static function getUrl(): string
    {
        return '/admin/headquarters';
    }
}
