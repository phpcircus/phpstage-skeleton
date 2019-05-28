<?php

namespace App\Services\User;

use App\Models\User;
use PerfectOblivion\Services\Traits\SelfCallingService;

class UpdateUserService
{
    use SelfCallingService;

    /** @var \App\Services\User\UpdateUserValidation */
    private $validator;

    /**
     * Construct a new UpdateUserService.
     *
     * @param  \App\Services\User\UpdateUserValidation  $validator
     */
    public function __construct(UpdateUserValidation $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Handle the call to the service.
     *
     * @return mixed
     */
    public function run(User $user, array $params)
    {
        $this->validator->validate($params);

        return $user->updateUserData([
            'name' => $params['name'],
            'email' => $params['email'],
        ]);
    }
}
