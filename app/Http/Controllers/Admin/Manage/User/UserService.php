<?php

namespace App\Http\Controllers\Admin\Manage\User;

use App\Http\Controllers\Admin\Manage\User\Resources\UserResource;
use App\Models\User;
use App\Utilities\Utility;
use Illuminate\Http\JsonResponse;

class UserService
{
    public function getUserList(array $requestData): JsonResponse
    {
        $formattedData = $this->formatUserListRequest($requestData);

        $users = UserResource::collection(
            User::withoutAdminUser()->latest('id')
                ->filterBy($formattedData['searchTxt'])
                ->paginate($formattedData['pageSize'])
        );
        return withSuccessResourceList($users);
    }

    public function updateUserStatus(array $requestData, int $userId): JsonResponse
    {

        if ($this->updateUserData($requestData, $userId)) {
            $user = $this->findUserByIdExceptSuperAdmin($userId);

            return withSuccess(new UserResource($user), 'User status updated successfully!');
        }

        return withError('User status update failed');
    }

    public function createUser(array $requestData): JsonResponse
    {
        $user = $this->createNewUser($requestData);

        return withSuccess(new UserResource($user->refresh()), 'User created successfully!');
    }

    public function updateUser(array $requestData, int $userId): JsonResponse
    {

        $formattedData = $this->formatUpdateRequestData($requestData);

        if ($this->updateUserData($formattedData, $userId)) {
            $user = $this->findUserByIdExceptSuperAdmin($userId);
            return withSuccess(new UserResource($user), 'User updated successfully!');
        }

        return withError('User updated Failed!');
    }

    public function deleteUser(int $userId): JsonResponse
    {
        if ($this->deleteUserData($userId)) {
            return withSuccess('', 'User deleted successfully!');
        }

        return withError('User deletion failed');
    }

    //Helper Methods

    public function createNewUser(array $requestData): User
    {
        return User::create($requestData);
    }

    public function formatUserListRequest(array $requestData): array
    {
        return [
            ...$requestData,
            'searchTxt' => $requestData['searchTxt'] ?? '',
            'status' => $requestData['status'] ?? '',
        ];
    }

    public function updateUserData(array $requestData, int $userId): bool
    {
        return User::notSuperAdmin()->where('id', $userId)
            ->update($requestData);
    }

    public function deleteUserData(int $userId): bool
    {
        return User::notSuperAdmin()->where('id', $userId)->delete();
    }

    public function findUserById(int $userId): ?User
    {
        return User::findOrFail($userId);
    }

    public function findUserByKeyValue(string $key, string $value, string $operator = '='): ?User
    {
        return User::where($key, $operator, $value)->firstOrFail();
    }

    public function findUserByIdExceptSuperAdmin(int $userId): ?User
    {
        return User::notSuperAdmin()->findOrFail($userId);
    }

    public function findUserByKeyValueExceptSuperAdmin(string $key, string $value, string $operator = '='): ?User
    {
        return User::notSuperAdmin()->where($key, $operator, $value)->firstOrFail();
    }

    public function convertUserStatusToTxt(): string
    {
        return implode(',', Utility::ALL_USER_STATUS);
    }

    public function formatUpdateRequestData(array $requestData): array
    {
        if (isset($requestData['password']) && !$requestData['password']) {
            unset($requestData['password']);
        }

        return $requestData;
    }
}
