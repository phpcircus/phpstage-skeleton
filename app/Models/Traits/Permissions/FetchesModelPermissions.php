<?php

namespace App\Models\Traits\Permissions;

use Illuminate\Support\Str;
use App\Authorization\Policies;
use Illuminate\Database\Eloquent\Model;

trait FetchesModelPermissions
{
    /**
     * Fetch the User permissions concerning the given model.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     */
    public function getModelPermissions(Model $model): array
    {
        $policies = resolve(Policies::class)->getPolicies();

        return collect($policies)->filter(function ($policy) use ($model) {
            return $this->isModelSpecificPolicy($policy);
        })->mapWithKeys(function ($policy, $key) use ($model) {
            return [$policy => $this->can($policy, $model)];
        })->toArray();
    }

    /**
     * Is the given policy a policy meant for determining permissions for a specific model?
     *
     * @param  string  $policy
     */
    private function isModelSpecificPolicy(string $policy): bool
    {
        $model = class_basename(static::class);

        return Str::endsWith($policy, "{$model}");
    }
}
