<?php

namespace App\Http\Responders\User;

use PerfectOblivion\Responder\Responder;

class StoreUserResponder extends Responder
{
    /**
     * Send a response.
     *
     * @return \Illuminate\View\View
     */
    public function respond()
    {
        flash('success', 'User created!');

        return redirect()->route('users.list');
    }
}
