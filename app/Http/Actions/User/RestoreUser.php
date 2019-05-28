<?php

namespace App\Http\Actions\User;

use App\Models\User;
use PerfectOblivion\Actions\Action;
use App\Services\User\RestoreUserService;
use App\Http\Responders\User\RestoreUserResponder;

class RestoreUser extends Action
{
    /** @var \App\Http\Responders\User\RestoreUserResponder */
    private $responder;

    /**
     * Construct a new RestoreUser action.
     *
     * @param  \App\Http\Responders\User\RestoreUserResponder  $responder
     */
    public function __construct(RestoreUserResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Restore a deleted user.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user)
    {
        $restored = RestoreUserService::call($user);

        return $this->responder->withPayload($restored)->respond();
    }
}
