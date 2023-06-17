<?php

namespace App\Http\Controllers\Admin\Manage\Admin\Resources;

use App\Http\Controllers\Admin\Manage\Role\Resources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'profile_pic' => $this->profile_pic,
            'user_type' => $this->admin_type,
            'status' => $this->status,
            'role' => new RoleResource($this->role),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
