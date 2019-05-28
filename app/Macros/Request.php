<?php

namespace App\Macros;

class Request
{
    /**
     * Request macro to check if current path is active.
     *
     * @return bool
     */
    public function isActive()
    {
        return function (string $segment) {
            return $segment === explode('/', $this->path())[0];
        };
    }

    /**
     * Request macro to check if current request is an api request.
     *
     * @return bool
     */
    public function isApi()
    {
        return function () {
            return request()->isActive('api');
        };
    }

    /**
     * Request macro to get the login credentials from the request.
     *
     * @param  string  ...$fields
     *
     * @return array
     */
    public function credentials()
    {
        return function (...$fields) {
            if (! $fields) {
                $fields = ['email', 'password'];
            }

            return request()->only($fields);
        };
    }

    /**
     * Request macro to verify that the user passed through the request is the currently authenticated user.
     *
     * @return bool
     */
    public function targetUserIsSelf()
    {
        return function () {
            $routeId = request()->route('user')
                ? request()->route('user')->getKey()
                : (request()->route('id') ? request()->route('id') : null);

            if (request()->user() && $routeId) {
                return (int) $routeId === request()->user()->getKey();
            }

            return false;
        };
    }
}
