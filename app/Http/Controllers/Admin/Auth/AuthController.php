<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Admin\Auth\Requests\AuthRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService)
    {
    }

    public function login(AuthRequest $request): JsonResponse
    {
        return $this->authService->loginAdmin($request->validated());
    }

    public function logout(Request $request)
    {
        return $this->authService->logoutAdmin();
    }
}
