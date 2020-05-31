<?php

namespace App\Http\Middleware;

use Closure;

class LoadJavaScript
{
    const JAVA_SCRITP_DIR = 'js';
    const JAVA_SCRIPT_EXTENSION = '.js';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $requestRouteName = $request->route()->getName();

        if ($requestRouteName === null) {
            $scriptPath = 'top';
        } else {
            $scriptPath = str_replace('.', '/', $requestRouteName);
        }

        view()->share('scriptPath', self::JAVA_SCRITP_DIR . '/' . $scriptPath . self::JAVA_SCRIPT_EXTENSION);

        return $next($request);
    }
}
