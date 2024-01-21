<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockUsers
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->blocked) {
            // Użytkownik jest zablokowany, możesz zaimplementować odpowiednie działania, np. przekierowanie
            return redirect()->route('blocked');
        }

        return $next($request);
    }
}
