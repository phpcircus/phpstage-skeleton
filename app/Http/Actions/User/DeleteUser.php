<?php

namespace App\Http\Actions\User;

use App\Models\User;
use PerfectOblivion\Actions\Action;
use App\Services\User\DeleteUserService;
use App\Http\Responders\User\DeleteUserResponder;

class DeleteUser extends Action
{
    /** @var \App\Http\Responders\User\DeleteUserResponder */
    private $responder;

    /**
     * Construct a new DeleteUser action.
     *
     * @param  App\Http\Responders\User\DeleteUserResponder  $responder
     */
    public function __construct(DeleteUserResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action to delete a user.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user)
    {
        $deleted = DeleteUserService::call($user);

        return $this->responder->withPayload($deleted)->respond();
    }
}
