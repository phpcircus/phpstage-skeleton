<?php

namespace App\Services\User;

use App\Models\User;
use PerfectOblivion\Services\Traits\SelfCallingService;

class DeleteUserService
{
    use SelfCallingService;

    /**
     * Handle the call to the service.
     *
     * @param  \App\Models\User  $user
     *
     * @return \App\Models\User
     */
    public function run(User $user)
    {
        return $user->deleteUser();
    }
}
