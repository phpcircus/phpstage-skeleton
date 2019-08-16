<?php

namespace App\Http\Actions\Auth\EmailVerification;

use Inertia\Inertia;
use Illuminate\Http\Request;
use PerfectOblivion\Actions\Action;

class ShowVerification extends Action
{
    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect()->route('dashboard')->with(['info' => 'User already verified!'])
                        : Inertia::render('Auth/Verify');
    }
}
