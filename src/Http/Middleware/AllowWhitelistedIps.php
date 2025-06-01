<?php

declare(strict_types=1);

namespace Atendwa\Whitelist\Http\Middleware;

use Atendwa\Whitelist\Facade\Whitelist;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Throwable;

class AllowWhitelistedIps
{
    /**
     * @throws Throwable
     */
    public function handle(Request $request, Closure $next): RedirectResponse|Redirector|Response
    {
        Whitelist::authorize();

        return $next($request);
    }
}
