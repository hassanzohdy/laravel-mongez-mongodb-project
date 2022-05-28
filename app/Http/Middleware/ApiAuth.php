<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiAuth
{
    /**
     * Api OS key
     *
     * @var string
     */
    protected string $apiOSKey;

    /**
     * {@inheritDoc}
     */
    public function handle(Request $request, Closure $next)
    {
        $agent = $request->header('os');
        $this->apiOSKey = config('auth.apiKeys.' . $agent, '');

        if ($request->authorizationValue() !== $this->apiOSKey) {
            return response([
                'data' => [
                    'error' => 'Invalid API Key.',
                ],
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
