<?php

namespace App\Services\User;

use App\Models\User;
use PerfectOblivion\Services\Traits\SelfCallingService;

class UpdateUserPasswordService
{
    use SelfCallingService;

    /** @var \App\Services\User\UpdateUserPasswordValidation */
    private $validator;

    /**
     * Construct a new UpdateUserPasswordService.
     *
     * @param  \App\Services\User\UpdateUserPasswordValidation
     */
    public function __construct(UpdateUserPasswordValidation $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Handle the call to the service.
     *
     * @param  \App\Models\User  $user
     * @param  array  $params
     *
     * @return mixed
     */
    public function run(User $user, array $params)
    {
        $this->validator->validate($params);

        return $user->updateUserPassword($params);
    }
}
