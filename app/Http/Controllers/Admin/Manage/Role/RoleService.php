<?php

namespace App\Http\Controllers\Admin\Manage\Role;

use App\Http\Controllers\Admin\Manage\Role\Resources\RoleListResource;
use App\Http\Controllers\Admin\Manage\Role\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;

class RoleService
{
    public function getRoles(array $requestData): JsonResponse
    {
        $formattedData = $this->formatRoleListRequest($requestData);
        $roles = RoleResource::collection(
            Role::latest('id')
                ->filterBy($formattedData['searchTxt'])
                ->paginate($formattedData['pageSize'])
        );
        return withSuccessResourceList($roles);
    }

    public function roleList(): JsonResponse
    {
        $roles = Role::select(['id', 'name'])->get();

        return withSuccess(RoleListResource::collection($roles));
    }

    public function createRole(array $requestData): JsonResponse
    {
        $role = Role::create($requestData);

        return withSuccess(new RoleResource($role->refresh()), 'Role created successfully!');
    }

    public function updateRole(array $requestData, int $roleId): JsonResponse
    {
        $role = $this->findRoleById($roleId);

        if ($role->update($requestData)) {
            return withSuccess(new RoleResource($role), 'Role updated successfully!');
        }

        return withError('Role updated Failed!');
    }

    public function deleteRole(int $roleId): JsonResponse
    {
        $role = $this->findRoleById($roleId);
        if ($role->delete()) {
            return withSuccess('', 'Role deleted successfully!');
        }

        return withError('Role deletion failed');
    }

    public function formatRoleListRequest(array $requestData): array
    {
        return [
            ...$requestData,
            'searchTxt' => $requestData['searchTxt'] ?? '',
            'status' => $requestData['status'] ?? '',
        ];
    }

    public function findRoleById(int $roleId): ?Role
    {
        return Role::findOrFail($roleId);
    }
}
