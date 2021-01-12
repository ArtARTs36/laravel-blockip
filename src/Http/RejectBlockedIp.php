<?php

namespace ArtARTs36\LaravelBlockIp\Http;

use ArtARTs36\LaravelBlockIp\Models\IP;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class RejectBlockedIp
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     * @throws AuthorizationException
     */
    public function handle($request, \Closure $next)
    {
        if (IP::isBlocked($request->ip())) {
            throw new AuthorizationException();
        }

        return $next($request);
    }
}
