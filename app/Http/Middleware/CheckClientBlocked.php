<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckClientBlocked
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $settings = settings()->all($fresh = true);

        if (
            $settings['subscription_active'] === 'no' &&
            ! $request->routeIs('payment.pending')
        ) {
            return redirect()->route('payment.pending');
        }

        return $next($request);
    }
}
