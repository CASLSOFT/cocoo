<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;

class ToUpperStrings extends TransformsRequest
{
    protected $except = [
        'password',
        'password_confirmation',
        'area',
        'email',
        'observation'
    ];

    protected function transform($key, $value)
    {
        if (in_array($key, $this->except, true)) {
            return $value;
        }

        return is_string($value) ? strtoupper($value) : $value;
    }
}
