<?php

namespace App\Http\Responders\User;

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
            'user' => [
                'id' => $this->payload->id,
                'name' => $this->payload->name,
                'email' => $this->payload->email,
                'deleted_at' => $this->payload->deleted_at,
            ],
        ]);
    }
}
