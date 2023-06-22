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
use Illuminate\Support\Carbon;

class DashboardService
{

    public function getAnalyticsData(): JsonResponse
    {
        $orderBy = [
            OrderBy::dimension('date', true),
            // OrderBy::metric('totalUsers', false),
        ];

        $dimensionFilter = new FilterExpression([
            'filter' => new Filter([
                'field_name' => 'customEvent:post_keywords',
                'string_filter' => new StringFilter([
                    'match_type' => MatchType::CONTAINS,
                    'value' => 'Navista',
                ]),
            ]),
        ]);

        $analyticsData = Analytics::get(
            Period::days(30),
            ['totalUsers'], //Metrics
            ['date', 'customEvent:post_keywords'], //Dimensions
            30, //Limit
            $orderBy, //order
            0, //Offset for pagination
            $dimensionFilter //filter by dimension
        );

        return withSuccess($analyticsData);

        $formattedData = $this->formatAnalyticsData($analyticsData);
        return withSuccess($formattedData);
    }

    public function getPageViewsDuration()
    {
        $analyticsData = Analytics::get(
            Period::days(30),
            ['activeUsers', 'screenPageViews', 'userEngagementDuration', 'averageSessionDuration'], //Metrics
            ['pageTitle', 'date'], //Dimensions
            30, //Limit
            [
                OrderBy::dimension('date', true)
            ], //order
            0, //Offset for pagination
            // filter by dimension
        );
        return $analyticsData;
    }

    public function getTotalDuration()
    {
        $analyticsData = Analytics::get(
            Period::days(30),
            ['userEngagementDuration']
        );
        return $analyticsData;
    }


    public function formatAnalyticsData($analyticsData): array
    {

        $formattedData = $analyticsData->map(function (array $item) {
            return [
                'totalUsers' => (int) $item['totalUsers'],
                'label' => Carbon::parse($item['date'])->format('l'),
            ];
        });

        return [
            'data' => $formattedData->pluck('totalUsers')->all(),
            'labels' => $formattedData->pluck('label')->all(),
        ];
    }
}
