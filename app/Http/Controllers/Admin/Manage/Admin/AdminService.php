<?php

namespace App\Http\Controllers\Admin\Manage\Admin;

use App\Http\Controllers\Admin\Manage\Admin\Resources\AdminResource;
use App\Http\Controllers\Admin\Manage\User\UserService;
use App\Models\User;
use App\Utilities\Utility;
use Illuminate\Http\JsonResponse;

class AdminService
{
    public function __construct(protected UserService $userService)
    {
    }

    public function getAdminList(array $requestData): JsonResponse
    {
        $formattedData = $this->userService->formatUserListRequest($requestData);
        $admins = AdminResource::collection(
            User::withAdminUser()->latest('id')
                ->with(['role'])
                ->filterBy($formattedData['searchTxt'])
                ->paginate($formattedData['pageSize'])
        );

        return withSuccessResourceList($admins);
    }

    public function updateAdminStatus(array $requestData, int $adminId): JsonResponse
    {
        if ($this->userService->updateUserData($requestData, $adminId)) {
            $admin = $this->userService->findUserByIdExceptSuperAdmin($adminId);

            return withSuccess(new AdminResource($admin), 'Admin status updated successfully!');
        }

        return withError('User status update failed');
    }

    public function createAdmin(array $requestData): JsonResponse
    {
        $formattedData = $this->formatCreateData($requestData);
        $admin = $this->userService->createNewUser($formattedData);

        return withSuccess(new AdminResource($admin->load(['role'])->refresh()), 'Admin created successfully!');
    }

    public function updateAdmin(array $requestData, int $adminId): JsonResponse
    {

        $formattedData = $this->userService->formatUpdateRequestData($requestData);

        if ($this->userService->updateUserData($formattedData, $adminId)) {
            $admin = $this->userService->findUserByIdExceptSuperAdmin($adminId);

            return withSuccess(new AdminResource($admin->load(['role'])), 'Admin updated successfully!');
        }

        return withError('Admin updated Failed!');
    }

    public function deleteAdmin(int $adminId): JsonResponse
    {
        if ($this->userService->deleteUserData($adminId)) {
            return withSuccess('', 'Admin deleted successfully!');
        }

        return withError('Admin deletion failed');
    }


    public function formatCreateData(array $requestData): array
    {
        $requestData['user_type'] = Utility::ADMIN;
        return $requestData;
    }
}
