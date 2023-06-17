<?php

namespace App\Http\Controllers\Admin\Manage\User;

use App\Http\Controllers\Admin\Manage\User\Requests\CreateUserRequest;
use App\Http\Controllers\Admin\Manage\User\Requests\UpdateStatusRequest;
use App\Http\Controllers\Admin\Manage\User\Requests\UpdateUserRequest;
use App\Http\Controllers\Admin\Manage\User\Requests\UserListRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function index(UserListRequest $request): JsonResponse
    {
        return $this->userService->getUserList($request->validated());
    }

    public function updateStatus(UpdateStatusRequest $request, $userId): JsonResponse
    {
        return $this->userService->updateUserStatus($request->validated(), $userId);
    }

    public function store(CreateUserRequest $request): JsonResponse
    {
        return $this->userService->createUser($request->validated());
    }

    public function update(UpdateUserRequest $request, $userId): JsonResponse
    {
        return $this->userService->updateUser($request->validated(), $userId);
    }

    public function delete(Request $request, $userId): JsonResponse
    {
        return $this->userService->deleteUser($userId);
    }
}
