<?php

namespace App\Http\Actions\Home;

use PerfectOblivion\Actions\Action;
use App\Http\Responders\Home\IndexResponder;

class Index extends Action
{
    /** @var \App\Http\Responders\Home\IndexResponder */
    private $responder;

    /**
     * Construct a new Home Index action.
     *
     * @param  \App\Http\Responders\Home\IndexResponder  $responder
     */
    public function __construct(IndexResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Show the application home page.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return $this->responder->respond();
    }
}
