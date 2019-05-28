<?php

namespace App\Http\Responders\User;

use PerfectOblivion\Responder\Responder;

class RestoreUserResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return mixed
     */
    public function respond()
    {
        return redirect()->back()->with(['success' => 'User restored!']);
    }
}
