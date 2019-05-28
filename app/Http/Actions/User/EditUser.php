<?php

namespace App\Http\Actions\User;

use App\Models\User;
use PerfectOblivion\Actions\Action;
use App\Http\Responders\User\EditUserResponder;

class EditUser extends Action
{
    /** @var \App\Http\Responders\User\EditUserResponder */
    private $responder;

    /**
     * Construct a new EditUser action.
     *
     * @param  \App\Http\Responders\User\EditUserResponder  $responder
     */
    public function __construct(EditUserResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Show the form to edit a user.
     *
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(User $user)
    {
        return $this->responder->withPayload($user)->respond();
    }
}
