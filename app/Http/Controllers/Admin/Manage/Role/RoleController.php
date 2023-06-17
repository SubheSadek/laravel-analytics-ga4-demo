<?php

namespace App\Http\Controllers\Admin\Manage\Role;

use App\Http\Controllers\Admin\Manage\Role\Requests\CreateRoleRequest;
use App\Http\Controllers\Admin\Manage\Role\Requests\RoleListRequest;
use App\Http\Controllers\Admin\Manage\Role\Requests\UpdateRoleRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    public function __construct(protected RoleService $roleService)
    {
    }

    public function index(RoleListRequest $request): JsonResponse
    {
        return $this->roleService->getRoles($request->validated());
    }

    public function roleList()
    {
        return $this->roleService->roleList();
    }

    public function store(CreateRoleRequest $request): JsonResponse
    {
        return $this->roleService->createRole($request->validated());
    }

    public function update(UpdateRoleRequest $request, $roleId): JsonResponse
    {
        return $this->roleService->updateRole($request->validated(), $roleId);
    }

    public function delete($roleId): JsonResponse
    {
        return $this->roleService->deleteRole($roleId);
    }
}
