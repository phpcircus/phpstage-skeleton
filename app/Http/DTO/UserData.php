<?php

namespace App\Http\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;
use Carbon\CarbonImmutable;

class UserData extends DataTransferObject
{
    /** @var int|null */
    public $id;

    /** @var string|null */
    public $name;

    /** @var string|null */
    public $email;

    /** @var string|null */
    public $password;

    /** @var \Carbon\CarbonImmutable|null */
    public $email_verified_at;

    /** @var bool */
    public $is_admin;

    /**
     * Construct a new UserData object.
     *
     * @param  array  $parameters
     */
    public function __construct(array $parameters)
    {
        $verified = $parameters['email_verified_at'] ?? null;
        $parameters['id'] = (int) $parameters['id'] ?? null;
        $parameters['name'] = (string) $parameters['name'] ?? null;
        $parameters['email'] = (string) $parameters['email'] ?? null;
        $parameters['password'] = (string) $parameters['password'] ?? null;
        $parameters['is_admin'] = (bool) $parameters['is_admin'] ?? false;

        if ($verified) {
            if (is_string($verified)) {
                $parameters['email_verified_at'] = new CarbonImmutable($verified);
            } elseif (! $verified instanceof CarbonImmutable) {
                $parameters['email_verified_at'] = null;
            }
        }

        parent::__construct($parameters);
    }

    /**
     * Create a new UserData object from request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public static function fromRequest(Request $request): UserData
    {
        return static::fromArray($request->only(['name', 'email', 'password']));
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
            'email_verified_at' => $data['email_verified_at'] ?? null,
            'is_admin' => $data['is_admin'] ?? null,
            'password' => $data['password'] ?? null,
        ]);
    }
}
