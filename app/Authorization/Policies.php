<?php

namespace App\Authorization;

class Policies
{
    /** @var array */
    protected $policies = [];

    /**
     * Set the application policies.
     *
     * @param  array  $policies
     */
    public function setPolicies($policies): void
    {
        $this->policies = $policies;
    }

    /**
     * Get the application policies.
     */
    public function getPolicies(): array
    {
        return $this->policies;
    }
}
