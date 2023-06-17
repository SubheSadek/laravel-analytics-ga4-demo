<?php

namespace App\Http\Controllers\Admin\Manage\Admin;

use App\Http\Controllers\Admin\Manage\Admin\Requests\AdminListRequest;
use App\Http\Controllers\Admin\Manage\Admin\Requests\CreateAdminRequest;
use App\Http\Controllers\Admin\Manage\Admin\Requests\UpdateAdminRequest;
use App\Http\Controllers\Admin\Manage\Admin\Requests\UpdateStatusRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(protected AdminService $adminService)
    {
    }

    public function index(AdminListRequest $request): JsonResponse
    {
        return $this->adminService->getAdminList($request->validated());
    }

    public function updateStatus(UpdateStatusRequest $request, $adminId): JsonResponse
    {
        return $this->adminService->updateAdminStatus($request->validated(), $adminId);
    }

    public function store(CreateAdminRequest $request): JsonResponse
    {
        return $this->adminService->createAdmin($request->validated());
    }

    public function update(UpdateAdminRequest $request, $adminId): JsonResponse
    {
        return $this->adminService->updateAdmin($request->validated(), $adminId);
    }

    public function delete(Request $request, $adminId): JsonResponse
    {
        return $this->adminService->deleteAdmin($adminId);
    }
}
