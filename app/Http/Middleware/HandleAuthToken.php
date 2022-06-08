<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HandleAuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->header('authorization'))
            return response(['message' => 'Usuário não autenticado'], 401);

        $token = explode(' ', stripslashes($request->header('authorization')))[1];

        $auth_user = DB::table('users')->where('token', '=', $token)->first();

        if (is_null($auth_user))
            return response(['message' => 'Usuário não autenticado'], 401);

        return $next($request);
    }
}
