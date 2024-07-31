<?php

namespace App\Http\Middleware;

use App\Http\Controllers\EmployeeController;
use Closure;
use Illuminate\Http\Request;

class CustomEmployeeCreation
{
    public function handle(Request $request, Closure $next)
    {
        dd('CUSTOM EMPLOYEE CREATION CONTROLLER ');
        // Redirect to your custom controller
        return redirect()->action([EmployeeController::class, 'create']);
    }
}
