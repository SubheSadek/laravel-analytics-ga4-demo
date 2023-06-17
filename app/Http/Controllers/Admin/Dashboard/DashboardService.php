<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Admin\Manage\User\UserService;
use App\Utilities\Utility;
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
            OrderBy::dimension('country', true),
            // OrderBy::metric('pageViews', false),
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

        $analyticsData = Analytics::get(Period::days(10), ['active1DayUsers', 'active7DayUsers', 'totalUsers'], ['country', 'browser', 'date'], 10);
        return withSuccess($dimensionFilter);
    }
}
