<?php

namespace App\Http\Filament\Auth;

use App\Providers\Filament\HeadquaterPanelProvider;
use App\Providers\Filament\PizzaPanelPanelProvider;
use App\Providers\Filament\PizzaPanelProvider;
use Filament\Pages\Auth\Login as BaseLogin;
use Filament\Http\Responses\Auth\Contracts\LoginResponse;
use Illuminate\Validation\ValidationException;


//=========THIS CLASS CAN BE REMOVED LATER==========
class CustomLogin extends BaseLogin
{
    public function authenticate(): ?LoginResponse
    {
        $data = $this->form->getState();

        if (!auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            throw ValidationException::withMessages([
                'data.email' => __('filament::login.messages.failed'),
            ]);
        }

        $user = auth()->user();
        dd('THIS IS FROM CUSTOM MIDDLEWARE =========', $user);
        // Custom redirection logic
        if ($user->isSuperAdmin()) {
            return $this->redirectToHeadquarters();
        } elseif ($user->company->type === 'pizza') {
            return $this->redirectToPizzaDashboard();
        }

        // Default redirection
        return app(LoginResponse::class);
    }

    protected function redirectToHeadquarters(): LoginResponse
    {
        session(['panel' => 'headquarter']);
        return app(LoginResponse::class)->setPath(HeadquaterPanelProvider::getUrl());
    }

    protected function redirectToPizzaDashboard(): LoginResponse
    {
        session(['panel' => 'pizza']);
        return app(LoginResponse::class)->setPath(PizzaPanelProvider::getUrl());
    }
}
