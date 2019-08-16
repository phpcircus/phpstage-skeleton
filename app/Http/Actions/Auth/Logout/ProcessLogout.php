<?php

namespace App\Http\Actions\Auth\Logout;

use Illuminate\Http\Request;
use PerfectOblivion\Actions\Action;
use Illuminate\Support\Facades\Auth;

class ProcessLogout extends Action
{
    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return redirect()->route('dashboard')->with(['success' => 'Logged out!']);
    }
}
