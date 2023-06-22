<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Admin\Dashboard\Requests\DashboardRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(protected DashboardService $dashboardService)
    {
    }

    public function getAnalytics(DashboardRequest $request): JsonResponse
    {
        return $this->dashboardService->getAnalyticsData($request->validated());
    }

    public function getPageViewsDuration(Request $request)
    {
        return $this->dashboardService->getPageViewsDuration($request->validated());
    }

    public function getTotalDuration(Request $request)
    {
        return $this->dashboardService->getTotalDuration($request);
    }
}
