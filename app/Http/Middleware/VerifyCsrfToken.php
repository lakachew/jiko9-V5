<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'api/v4/authenticate',
        'api/v4/authenticate/user',
        'api/v4/authenticate/user/works',
        'api/v4/authenticate/user/worklog',
        'api/v4/authenticate/user/worklog/start',
        'api/v4/authenticate/user/worklog/stop',
    ];
}
