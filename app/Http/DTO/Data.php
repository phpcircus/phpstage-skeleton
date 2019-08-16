<?php

namespace App\Http\DTO;

use Illuminate\Support\Arr;
use Illuminate\Support\Fluent;

class Data extends Fluent
{
    /**
     * Construct a new Data.
     *
     * @param  array  $attributes
     */
    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }

        parent::__construct($attributes);
    }

    /**
     * Add the given properties to the instance.
     *
     * @param  array  $element
     */
    public function with(array $element): Data
    {
        foreach ($element as $key => $value) {
            $this->{$key} = $value;
            $this->attributes[$key] = $value;
        }

        return $this;
    }

    /**
     * Retrieve all but the given properties.
     *
     * @param  string|array $keys
     */
    public function except($keys): array
    {
        return Arr::except($this->toArray(), $keys);
    }

    /**
     * Retrieve only the given properties.
     *
     * @param  string|array $keys
     */
    public function only($keys): array
    {
        return Arr::only($this->toArray(), $keys);
    }

    /**
     * Retrieve all of the given properties.
     *
     * @param  mixed $keys
     */
    public function all($keys = null): array
    {
        $input = $this->getAttributes();

        if (! $keys) {
            return $input;
        }

        $results = [];

        foreach (is_array($keys) ? $keys : func_get_args() as $key) {
            Arr::set($results, $key, Arr::get($input, $key));
        }

        return $results;
    }
}
