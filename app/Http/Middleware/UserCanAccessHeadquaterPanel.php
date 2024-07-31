<?php

namespace App\Http\Middleware;

use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCanAccessHeadquaterPanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $currentPanel = Filament::getCurrentPanel()->getId();
        $user = auth()->user();

        // Check if the user is authenticated and is a super admin accessing the 'headquater' panel
        if ($user && $user->isSuperAdmin() && $currentPanel === 'headquater') {
            return $next($request);
        }

        // Log out any authenticated user and redirect to the login route
        auth()->logout();

        return redirect()->route('filament.auth.auth.login');
    }
}
