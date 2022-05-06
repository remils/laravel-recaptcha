<?php

namespace Remils\LaravelRecaptcha\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool verify(string $response, string $ip = null)
 */
class Recaptcha extends Facade
{
    /**
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'recaptcha';
    }
}
