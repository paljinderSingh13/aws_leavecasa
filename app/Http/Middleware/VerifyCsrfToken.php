<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification. 6297
     *
     * @var array
     */
    protected $except = [
        'administrator/payment/response/*',
        'book/flight',
        'http://127.0.0.1:8000/payment_response',
        'https://leavecasa.com/payment_response',
        'https://leavecasa.com/flight_payment_response',
        'http://leavecasa.com/payment_response',
        'https://leavecasa.com/wallet_payment_response',
        'https://leavecasa.com/bus-pay-response'
    ];
}
