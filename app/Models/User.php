<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Authorization\Policies;
use App\Models\Traits\Uuid\HasUuids;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Builders\User\UserQueryBuilder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Traits\Permissions\FetchesModelPermissions;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Authenticatable implements AuthorizableContract, MustVerifyEmail
{
    use HasUuids;
    use Notifiable;
    use SoftDeletes;
    use Authorizable;
    use FetchesModelPermissions;

    /** @var array */
    protected $guarded = [];

    /** @var int */
    protected $perPage = 10;

    /** @var array */
    protected $casts = ['is_admin' => 'boolean'];

    /** @var array */
    protected $appends = ['is_super_admin'];

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new UserQueryBuilder($query);
    }

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
     * Get the is_super_admin attribute.
     */
    public function getIsSuperAdminAttribute(): bool
    {
        return $this->email === config('auth.admin.email');
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
     * @return \App\Models\User
     */
    public function createUser(array $user)
    {
        return $this->create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
            'is_admin' => $user['is_admin'],
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
     * @return \App\Models\User
     */
    public function updateUserData(array $data)
    {
        return tap($this, function ($user) use ($data) {
            return $user->update($data);
        })->fresh();
    }

    /**
     * Update user password.
     *
     * @return \App\Models\User
     */
    public function updateUserPassword(array $data)
    {
        return tap($this, function ($user) use ($data) {
            return $user->update([
                'password' => bcrypt($data['password']),
            ]);
        })->fresh();
    }

    /**
     * Fetch the general User permissions that don't apply to a specific model.
     * These permissions are based on the class, generically, not the model.
     */
    public function getAuthorizationDetails(): array
    {
        $policies = resolve(Policies::class)->getPolicies();

        return collect($policies)->filter(function ($policy) {
            return $this->isGeneralPolicy($policy);
        })->mapWithKeys(function ($policy, $key) {
            return [$policy => $this->can($policy)];
        })->toArray();
    }

    /**
     * Is the given policy a general policy, meant for determining general permissions for the class?
     */
    private function isGeneralPolicy(string $policy): bool
    {
        $model = class_basename(static::class);

        return Str::endsWith($policy, "{$model}s");
    }
}
