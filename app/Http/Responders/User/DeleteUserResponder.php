<?php

namespace App\Http\Responders\User;

use PerfectOblivion\Responder\Responder;

class DeleteUserResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return mixed
     */
    public function respond()
    {
        return redirect()->route('users')->with(['success' => 'User deleted!']);
    }
}
