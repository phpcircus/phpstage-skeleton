<?php

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Arr;
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
     * @param  \App\Models\User  $user
     * @param  array  $data
     *
     * @return mixed
     */
    public function run(User $user, array $data)
    {
        $this->validator->validate($data);

        return $user->updateUserData(Arr::only($data, ['name', 'email']));
    }
}
