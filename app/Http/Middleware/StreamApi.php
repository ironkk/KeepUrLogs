<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Stream;

class StreamApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //search stream
        $stream = Stream::where('api_key', $request->get('api_token'))
                    ->first();

        if ($stream && $stream->active) {
            return $next($request);
        }

        $response = [
            'success' => false,
            'message' => 'not valid token',
        ];
        return response()->json($response);
    }
}
