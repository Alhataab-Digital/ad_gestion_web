<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Utilisateur;
use App\Models\ConnexionUser;
use App\Models\UserEnLigne;

class Initialiser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(isset(UserEnLigne::where('utilisateur_id',Auth::user()->id)->first()->id)){
            return $next($request);
        }
        return redirect('/');
    }
}
