<?php

namespace App\Macros;

use Illuminate\Support\Arr;

class Collection
{
    /**
     * Macro helper that will return all of the given keys from the collection.
     * If keys are passed, return those as well, even if they don't exist.
     *
     * @return \Illuminate\Support\Collection
     */
    public function obtain()
    {
        return function ($keys) {
            $items = $this->items;

            if (! $keys) {
                return $items;
            }

            $results = [];

            foreach (is_array($keys) ? $keys : func_get_args() as $key) {
                Arr::set($results, $key, Arr::get($items, $key));
            }

            return collect($results);
        };
    }
}
