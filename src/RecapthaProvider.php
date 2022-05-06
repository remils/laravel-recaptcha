<?php

namespace Remils\LaravelRecaptcha;

use Remils\LaravelRecaptcha\Http\Middleware\Recaptcha as RecaptchaMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class RecapthaProvider extends ServiceProvider
{
    public function boot(Router $router)
    {
        $router->aliasMiddleware('recaptcha', RecaptchaMiddleware::class);

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/recaptha.php' => config_path('recaptcha.php'),
            ], 'config');
        }
    }

    public function register()
    {
        $this->app->bind('recaptcha', Recaptcha::class);
    }
}
