<?php

namespace App\Http\Responders\User;

use App\Http\Resources\UserResource;
use Inertia\Inertia;
use PerfectOblivion\Responder\Responder;

class EditUserResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return \Illuminate\View\Viow
     */
    public function respond()
    {
        return Inertia::render('Users/Edit', [
            'user' => new UserResource($this->payload),
        ]);
    }
}
