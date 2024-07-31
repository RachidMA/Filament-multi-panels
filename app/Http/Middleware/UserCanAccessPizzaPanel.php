<?php

namespace App\Http\Middleware;

use App\Models\Company;
use App\Models\Role;
use App\Models\User;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserCanAccessPizzaPanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        // Get the current panel ID
        $currentPanelId = Filament::getCurrentPanel()->getId();

        // Retrieve the authenticated user
        $user = auth()->user();
        //dd('FROM MIDDLEWARE ', $user);
        // Check if the user is authenticated
        if (!$user) {
            return redirect()->route('filament.auth.auth.login');
        }

        // Retrieve the company associated with the user
        //$company = Company::with('company_type')->find($user->userable_id);
        $company = Company::withoutGlobalScope('user')
            ->with('company_type')
            ->find($user->userable_id);
        //dd('THIS IS FROM USER CAN', $company->id === $user->userable_id);
        // Verify if the company exists and the IDs match
        if ($company && $company->id === $user->userable_id) {

            /* IMPORTANT NOT
               Check if the user is not a super admin and the current panel is 'pizza' 
               or the user is a super admin and ensure they have the correct email
               (TO MAKE SURE SUPER ADMIN HAS ACCESS TO OTHER SUBCOMPANIES PANELS)
            */
            if ((!$user->isSuperAdmin() && $currentPanelId === 'pizza') || $user->isSuperAdmin()) {
                //dd('this is user ', $user);
                return $next($request);
            }
        }

        // Log out the user and redirect to login if conditions are not met
        auth()->logout();

        return redirect()->route('filament.auth.auth.login');
    }
}
