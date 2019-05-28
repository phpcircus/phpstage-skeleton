<?php

namespace App\Http\Actions\Auth\Register;

use Inertia\Inertia;
use PerfectOblivion\Actions\Action;

class ShowForm extends Action
{
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return Inertia::render('Auth/Register');
    }
}
