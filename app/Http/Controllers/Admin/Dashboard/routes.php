<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('dashboard')->as('dashboard.')
    ->middleware('auth')
    ->controller(DashboardController::class)
    ->group(function ($route) {
        $route->get('get-analytics', 'getAnalytics')->name('get_analytics');
        $route->get('get-page-views-duration', 'getPageViewsDuration')->name('get_page_views_duration');
        $route->get('get-total-duration', 'getTotalDuration')->name('get_total_duration');
    });
