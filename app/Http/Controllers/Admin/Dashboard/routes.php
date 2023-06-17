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
    });
