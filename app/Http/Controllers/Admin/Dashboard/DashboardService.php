<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Admin\Manage\User\UserService;
use App\Utilities\Utility;
use Google\Analytics\Data\V1alpha\Filter\NumericFilter;
use Illuminate\Http\JsonResponse;

use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Spatie\Analytics\OrderBy;

use Google\Analytics\Data\V1beta\Filter;
use Google\Analytics\Data\V1beta\FilterExpression;
use Google\Analytics\Data\V1beta\Filter\StringFilter;
use Google\Analytics\Data\V1beta\Filter\StringFilter\MatchType;

class DashboardService
{

    public function getAnalyticsData(): JsonResponse
    {
        $orderBy = [
            OrderBy::dimension('browser', true),
            // OrderBy::metric('totalUsers', false),
        ];

        $dimensionFilter = new FilterExpression([
            'filter' => new Filter([
                'field_name' => 'eventName',
                'string_filter' => new StringFilter([
                    'match_type' => MatchType::EXACT,
                    'value' => 'click',
                ]),
            ]),
        ]);
        $analyticsData = Analytics::get(Period::days(1), ['totalUsers', 'sessions'], ['date', 'eventName', 'pageTitle', 'browser'], 15, $orderBy);
        return withSuccess($analyticsData);
    }
}
