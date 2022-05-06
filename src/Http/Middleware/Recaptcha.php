<?php

namespace Remils\LaravelRecaptcha\Http\Middleware;

use Closure;
use Remils\LaravelRecaptcha\Exceptions\RecaptchaException;
use Remils\LaravelRecaptcha\Facades\Recaptcha as RecaptchaFacade;

class Recaptcha
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure                  $next
     * @param  string                    $name
     * @return mixed
     *
     * @throws \Remils\LaravelRecaptcha\Exceptions\RecaptchaException
     */
    public function handle($request, Closure $next, $name)
    {
        if (RecaptchaFacade::verify($request->input($name), $request->ip())) {
            return $next($request);
        }

        throw new RecaptchaException(['error-middleware']);
    }
}
