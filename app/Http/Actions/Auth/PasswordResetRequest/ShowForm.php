<?php

namespace App\Http\Actions\Auth\PasswordResetRequest;

use Inertia\Inertia;
use PerfectOblivion\Actions\Action;

class ShowForm extends Action
{
    /**
     * Show the password reset request form.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return Inertia::render('Auth/PasswordResetRequest');
    }
}
