<?php

namespace App\Http\Actions\User;

use App\Models\User;
use Illuminate\Http\Request;
use PerfectOblivion\Actions\Action;
use App\Services\User\UpdateUserService;
use App\Services\User\UpdateUserPasswordService;
use App\Http\Responders\User\UpdateUserResponder;

class UpdateUser extends Action
{
    /** @var \App\Http\Responders\User\UpdateUserResponder */
    private $responder;

    /**
     * Construct a new UpdateUser action.
     *
     * @param  \App\Http\Responders\User\UpdateUserResponder  $responder
     */
    public function __construct(UpdateUserResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Update a user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request, User $user)
    {
        $updated = UpdateUserService::call($user, $request->only(['id', 'name', 'email']));

        if ($request->password) {
            UpdateUserPasswordService::call($user, $request->only(['password']));
        }

        return $this->responder->withPayload($updated)->respond();
    }
}
