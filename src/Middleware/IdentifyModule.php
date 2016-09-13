<?php

namespace Samcrosoft\LaravelModules\Middleware;

use Closure;
use Samcrosoft\LaravelModules\Modules;

/**
 * Class IdentifyModule
 *
 * @package Samcrosoft\LaravelModules\Middleware
 */
class IdentifyModule
{
    /**
     * @var Modules
     */
    protected $module;

    /**
     * Create a new IdentifyModule instance.
     *
     * @param Modules $module
     */
    public function __construct(Modules $module)
    {
        $this->module = $module;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $slug)
    {
        $request->session()->put('module', $this->module->where('slug', $slug));

        return $next($request);
    }
}
