<?php

namespace Remils\LaravelRecaptcha;

use Illuminate\Support\Facades\Http;
use Remils\LaravelRecaptcha\Exceptions\RecaptchaException;

class Recaptcha
{
    /**
     * @param  string $response
     * @param  string $ip
     * @return bool
     *
     * @throws \Remils\LaravelRecaptcha\Exceptions\RecaptchaException
     */
    public function verify($response, $ip = null)
    {
        $data = [
            'secret'   => config('recaptcha.secret_key'),
            'response' => $response
        ];

        if ($ip) {
            $data['remoteip'] = $ip;
        }

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', $data);

        $body = json_decode($response->body(), true);

        if ($body['success']) {
            return (float) $body['score'] > (float) config('recaptcha.min_score');
        }

        throw new RecaptchaException($body['error-codes']);
    }
}
