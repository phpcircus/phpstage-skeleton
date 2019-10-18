<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Arr;
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
     * @param  array  $data
     *
     * @return \App\Models\User
     */
    public function run(array $data)
    {
        $this->validator->validate($data);

        return $this->users->createUser(Arr::only($data, ['id', 'name', 'email', 'password', 'is_admin']));
    }
}
