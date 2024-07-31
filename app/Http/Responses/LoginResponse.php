<?php


namespace App\Http\Responses;

use Filament\Facades\Filament;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponse extends \Filament\Http\Responses\Auth\LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {

        // /dd('this is the cookie ', request()->getSession());
        return redirect()->to(auth()->user()->usersPanel());
    }
}
