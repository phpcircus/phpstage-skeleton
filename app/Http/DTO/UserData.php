<?php

namespace App\Http\DTO;

use Illuminate\Http\Request;

class UserData extends Data
{
    /** @var int|null */
    public $id;

    /** @var string|null */
    public $name;

    /** @var string|null */
    public $email;

    /** @var string|null */
    public $password;

    /** @var bool */
    public $is_admin;

    /**
     * Construct a new UserData object.
     *
     * @param  array  $parameters
     */
    public function __construct(array $parameters)
    {
        parent::__construct($this->validate($parameters));
    }

    /**
     * Create a new UserData object from request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public static function fromRequest(Request $request): UserData
    {
        return static::fromArray($request->only(['id', 'name', 'email', 'password', 'is_admin']));
    }

    /**
     * Create a new UserData object from an array.
     *
     * @param  array  $data
     */
    public static function fromArray(array $data): UserData
    {
        return new self([
            'id' => $data['id'] ?? null,
            'name' => $data['name'] ?? null,
            'email' => $data['email'] ?? null,
            'is_admin' => $data['is_admin'] ?? false,
            'password' => $data['password'] ?? null,
        ]);
    }

    /**
     * Validate the given parameters.
     *
     * @param  array  $parameters
     */
    public function validate(array $parameters): array
    {
        $id = isset($parameters['id']) ? (string) $parameters['id'] : null;
        $name = isset($parameters['name']) ? (string) $parameters['name'] : null;
        $email = isset($parameters['email']) ? (string) $parameters['email'] : null;
        $isAdmin = isset($parameters['is_admin']) ? (bool) $parameters['is_admin'] : false;
        $password = isset($parameters['password']) ? (string) $parameters['password'] : null;

        $parameters['id'] = $id;
        $parameters['name'] = $name;
        $parameters['email'] = $email;
        $parameters['is_admin'] = $isAdmin;
        $parameters['password'] = $password;

        return $parameters;
    }
}
