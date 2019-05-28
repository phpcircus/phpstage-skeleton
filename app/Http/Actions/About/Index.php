<?php

namespace App\Http\Actions\About;

use PerfectOblivion\Actions\Action;
use App\Http\Responders\About\IndexResponder;

class Index extends Action
{
    /** @var \App\Http\Responders\About\IndexResponder */
    private $responder;

    /**
     * Construct a new About Index action.
     *
     * @param  \App\Http\Responders\About\IndexResponder  $responder
     */
    public function __construct(IndexResponder $responder)
    {
        $this->responder = $responder;
    }

    /**
     * Execute the action.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return $this->responder->respond();
    }
}
