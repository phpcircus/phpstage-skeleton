<?php

namespace App\Http\Actions\Auth\EmailVerification;

use Illuminate\Http\Request;
use PerfectOblivion\Actions\Action;

class ResendVerify extends Action
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('throttle:6,1');
    }

    /**
     * Resend the email verification email.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();

        redirect_if($user->hasVerifiedEmail(), route('home'), ['info' => 'User already verified.']);

        $user->sendEmailVerificationNotification();

        return back()->with(['success' => 'The verification email has been resent.']);
    }
}
