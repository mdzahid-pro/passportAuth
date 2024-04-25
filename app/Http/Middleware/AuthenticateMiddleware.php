<?php

namespace App\Http\Middleware;

use App\Traits\ResponseTrait;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

class AuthenticateMiddleware extends \Illuminate\Auth\Middleware\Authenticate
{
    use ResponseTrait;

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            return $this->responseError(null, 'Unauthenticated access');
        }
    }

    /**
     * Handle an unauthenticated user.
     *
     * @param $request
     * @param  array  $guards
     * @return void
     *
     */
    protected function unauthenticated($request, array $guards): void
    {
        throw new HttpResponseException(
            $this->responseError(null, 'Unauthenticated access.')
        );
    }
}
