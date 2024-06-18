<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NoCache
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
        $response = $next($request);
        $response->headers->set('Cache-Control','no-cache, no-store, max-age=0, must-revalidate');
        $response->headers->set('Cache-Control: post-check=0, pre-check=0', false);
        $response->headers->set('Pragma','no-cache');
        $response->headers->set('Expires','Sun, 02 Jan 1990 00:00:00 GMT');
        return $response;
    }
}
