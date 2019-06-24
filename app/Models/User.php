<?php

namespace App\Models;

use App\Http\DTO\UserData;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Authenticatable implements AuthorizableContract, MustVerifyEmail
{
    use SoftDeletes;
    use Authorizable;
    use Notifiable;

    /** @var array */
    protected $guarded = [];

    /** @var int */
    protected $perPage = 10;

    /** @var array */
    protected $casts = ['is_admin' => 'boolean'];

    /**
     * A user has many posts.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Order query by user name.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderByName($builder)
    {
        $builder->orderBy('name');
    }

    /**
     * Filter the query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  array  $filters
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($builder, array $filters)
    {
        $builder->when($filters['search'] ?? null, function ($builder, $search) {
            $builder->where(function ($builder) use ($search) {
                $builder->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        })->when($filters['trashed'] ?? null, function ($builder, $trashed) {
            if ('with' === $trashed) {
                $builder->withTrashed();
            } elseif ('only' === $trashed) {
                $builder->onlyTrashed();
            }
        });
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function resolveRouteBinding($value)
    {
        return in_array(SoftDeletes::class, class_uses($this))
            ? $this->where($this->getRouteKeyName(), $value)->withTrashed()->first()
            : parent::resolveRouteBinding($value);
    }

    /**
     * Create a user with the provided data.
     *
     * @param  \App\Http\DTO\UserData  $user
     *
     * @return \App\Models\User
     */
    public function createUser(UserData $user)
    {
        return $this->create([
            'name' => $user->name,
            'email' => $user->email,
            'password' => bcrypt($user->password),
            'is_admin' => $user->is_admin,
        ]);
    }

    /**
     * Delete a user.
     *
     * @return \App\Models\User
     */
    public function deleteUser()
    {
        return tap($this, function ($instance) {
            return $this->delete();
        });
    }

    /**
     * Restore a deleted user.
     *
     * @return \App\Models\User
     */
    public function restoreUser()
    {
        return tap($this, function ($instance) {
            return $this->restore();
        });
    }

    /**
     * Update user data.
     *
     * @param  \App\Http\DTO\UserData  $data
     *
     * @return \App\Models\User
     */
    public function updateUserData(UserData $data)
    {
        return tap($this, function ($user) use ($data) {
            return $user->update($data->toArray());
        })->fresh();
    }

    /**
     * Update user password.
     *
     * @param  \App\Http\DTO\UserData  $data
     *
     * @return \App\Models\User
     */
    public function updateUserPassword(UserData $data)
    {
        return tap($this, function ($user) use ($data) {
            return $user->update([
                'password' => bcrypt($data->password),
            ]);
        })->fresh();
    }
}
