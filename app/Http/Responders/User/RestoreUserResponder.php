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
        $this->request->session()->flash('success', 'User restored!');

        return redirect()->back();
    }
}
