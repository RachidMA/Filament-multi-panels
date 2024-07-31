<?php

namespace App\Http\Responses;

use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LogoutResponse extends \Filament\Http\Responses\Auth\LogoutResponse
{
    public function toResponse($request): RedirectResponse
    {

        return redirect()->route('filament.auth.auth.login');
    }
}
