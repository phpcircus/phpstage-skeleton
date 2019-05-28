<?php

namespace App\Models\Traits\Slug;

use Exception;

class InvalidOption extends Exception
{
    /**
     * Generate exception when unable to determine the sluggable fields.
     */
    public static function missingFromField()
    {
        return new static('Could not determine which fields should be sluggified');
    }

    /**
     * Generate exception when slug field is missing.
     */
    public static function missingSlugField()
    {
        return new static('Could not determine in which field the slug should be saved');
    }

    /**
     * Generate exception when maximum length is exceeded.
     */
    public static function invalidMaximumLength()
    {
        return new static('Maximum length should be greater than zero');
    }
}
