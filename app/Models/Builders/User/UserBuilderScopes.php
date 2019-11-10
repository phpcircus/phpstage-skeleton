<?php

namespace App\Models\Builders\User;

trait UserBuilderScopes
{
    /**
     * Order the query by user name.
     */
    public function orderByName(): UserQueryBuilder
    {
        return $this->orderBy('name');
    }

    /**
     * Filter the query based on the given filters.
     *
     * @return mixed
     */
    public function filter(array $filters): UserQueryBuilder
    {
        return $this->when($filters['search'] ?? null, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                return $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ('with' === $trashed) {
                return $query->withTrashed();
            } elseif ('only' === $trashed) {
                return $query->onlyTrashed();
            }
        });
    }
}
