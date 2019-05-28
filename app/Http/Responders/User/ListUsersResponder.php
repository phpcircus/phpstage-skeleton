<?php

namespace App\Http\Responders\User;

use Inertia\Inertia;
use PerfectOblivion\Responder\Responder;

class ListUsersResponder extends Responder
{
    /**
     * Send a list of users as a response.
     *
     * @return \Illuminate\View\View
     */
    public function respond()
    {
        return Inertia::render('Users/Index', $this->payload);
    }
}
