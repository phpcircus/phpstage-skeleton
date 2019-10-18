<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'email' => $this->email,
            'is_admin' => $this->is_admin,
            'is_super_admin' => $this->is_super_admin,
            'allows' => $this->getResourcePermissions(),
        ];
    }

    /**
     * Get the authorization details for the resource.
     */
    public function getResourcePermissions(): array
    {
        return $this->getModelPermissions($this->resource);
    }
}
