<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContentHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('Content-Type') !== 'application/json') {
            return response()->json([
                'error' => 'Unsupported Media Type',
            ], 415);
        }

        return $next($request);
    }
}
