<?php

namespace App\Services\User;

use App\Models\User;
use PerfectOblivion\Services\Traits\SelfCallingService;

class StoreUserService
{
    use SelfCallingService;

    /** @var \App\Services\StoreUserValidation */
    private $validator;

    /** @var \App\Models\User */
    private $users;

    /**
     * Construct a new StoreUserService.
     *
     * @param  \App\Services\StoreUserValidation  $validator
     * @param  \App\Models\User  $users
     */
    public function __construct(StoreUserValidation $validator, User $users)
    {
        $this->validator = $validator;
        $this->users = $users;
    }

    /**
     * Handle the call to the service.
     *
     * @param  array  $params
     *
     * @return \App\Models\User
     */
    public function run(array $params)
    {
        $this->validator->validate($params);

        return $this->users->createUser($params);
    }
}
