<?php

namespace App\Http\Middleware;

use App\Dtos\AppHeadersDto;
use App\Services\Contracts\AppHeaderServiceContract;
use Closure;
use Illuminate\Http\Request;

class AppHeadersMiddleware
{
    public function __construct(
        private AppHeaderServiceContract $appHeaderService
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $this->appHeaderService->sync(AppHeadersDto::init($request->headers->all()));
        return $next($request);
    }
}
