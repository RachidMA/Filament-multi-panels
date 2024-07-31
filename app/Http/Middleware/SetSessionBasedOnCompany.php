<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetSessionBasedOnCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd('THIS IS SET SESSION MIDDLEWARE');
        // if (auth()->check()) {
        //     $user = auth()->user();

        //     dd($user);

        //     if ($user->isSuperAdmin() && $user->email == config('mail.from.address') && $user->userable instanceof \App\Models\Headquater) {
        //         $sessionName = 'headquarter_session';
        //     } else {
        //         $companyId = $user->userable->id ?? 'default';
        //         $sessionName = "company_{$companyId}_session";
        //     }

        //     config(['session.cookie' => $sessionName]);
        // }
        // $user = auth()->user();
        // //dd('THIS IS FROM SET SESSION ', $user);
        // if ($user) {
        //     $companyId = $user->userable ? str_replace(' ', '-', $user->userable->name) : 'default';
        //     $sessionName = $user->isSuperAdmin() && $user->email == config('mail.from.address') && $user->userable instanceof \App\Models\Headquater
        //         ? 'HEADQUATER_company_session_' . $companyId
        //         : "SUB_company_{$companyId}_session";

        //     $currentSessionData = Session::all();

        //     Session::put($sessionName, $currentSessionData);
        //     $currentSessionData = Session::all();
        //     dd('THIS IS CURRENT SESSION DATA ', $currentSessionData);
        //     config(['session.cookie' => $sessionName]);
        //     session()->regenerate();
        // }
        if (auth()->check()) {
            $user = auth()->user();
            //dd('THIS IS FROM SET SESSION USER ', $user);
            // Assuming the user has a relationship to company
            // and the company has an 'id' field
            $companyId = $user->userable ? str_replace(' ', '-', $user->userable->name) : 'default';
            $sessionName = $user->isSuperAdmin() && $user->email == config('mail.from.address') && $user->userable instanceof \App\Models\Headquater
                ? 'HEADQUATER_company_session_' . $companyId
                : "SUB_company_{$companyId}_session";

            // Set a unique session name for each company
            //$sessionName = "company_{$companyId}_session";

            // Config::set('session.cookie', $sessionName);
            // session()->regenerate();
            $currentSessionData = Session::all();

            Session::put($sessionName, $currentSessionData);
            //$currentSessionData = Session::all();
            //dd('THIS IS CURRENT SESSION DATA ', $currentSessionData);
            config(['session.cookie' => $sessionName]);
            session()->regenerate();

            //dd('THIS IS NEW SESSION ',  request()->getSession());
            // Optionally, you can also set a unique session driver if needed
            // Config::set('session.driver', 'company_' . $companyId);
        }

        return $next($request);
    }
}
