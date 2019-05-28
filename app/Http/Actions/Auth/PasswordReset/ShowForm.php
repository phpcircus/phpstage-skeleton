<?php

namespace App\Http\Actions\Auth\PasswordReset;

use Inertia\Inertia;
use Illuminate\Http\Request;
use PerfectOblivion\Actions\Action;

class ShowForm extends Action
{
    /**
     * Display the password reset view for the given token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request, ?string $token = null)
    {
        return Inertia::render('Auth/PasswordReset', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }
}
