<?php

namespace Remils\LaravelRecaptcha\Exceptions;

use Exception;

class RecaptchaException extends Exception
{
    /** @var array */
    protected $errorCodes;

    /**
     * @param array $errorCodes
     */
    public function __construct($errorCodes)
    {
        parent::__construct(trans('Invalid recaptcha.'));

        $this->errorCodes = $errorCodes;
    }

    /**
     * @return array
     */
    public function getErrorCodes()
    {
        return $this->errorCodes;
    }
}
