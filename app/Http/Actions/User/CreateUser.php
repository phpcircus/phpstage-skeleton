<?php

namespace App\Http\Actions\User;

use PerfectOblivion\Actions\Action;
use App\Http\Responders\User\CreateUserResponder;

class CreateUser extends Action
{
    /** @var \App\Http\Responders\User\CreateUserResponder */
    private $responder;

    /**
     * Create a new CreateUser action.
     *
     * @param  \App\Http\Responders\User\CreateUserResponder  $responder
     */
    public function __construct(CreateUserResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Show the create user form.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return $this->responder->respond();
    }
}
