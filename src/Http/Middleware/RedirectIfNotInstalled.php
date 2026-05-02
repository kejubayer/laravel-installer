<?php

namespace Kejubayer\Installer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotInstalled
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! file_exists(storage_path('installed'))) {
            return redirect()->route('installer.index');
        }

        return $next($request);
    }
}
