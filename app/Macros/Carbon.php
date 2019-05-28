<?php

namespace App\Macros;

use OpenPsa\Ranger\Ranger;

class Carbon
{
    /**
     * Carbon Macro to create date range.
     *
     * @return string
     */
    public function range()
    {
        return function ($to) {
            return (new Ranger('en'))->format(
                $this->toDateString(),
                $to->toDateString()
            );
        };
    }
}
