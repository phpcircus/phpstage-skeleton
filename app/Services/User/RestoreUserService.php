<?php

namespace App\Services\User;

use App\Models\User;
use PerfectOblivion\Services\Traits\SelfCallingService;

class RestoreUserService
{
    use SelfCallingService;

    /**
     * Handle the call to the service.
     *
     * @return \App\Models\User
     */
    public function run(User $user)
    {
        return $user->restoreUser();
    }
}
