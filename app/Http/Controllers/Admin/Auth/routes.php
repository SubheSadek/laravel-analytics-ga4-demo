<?php

use App\Http\Controllers\Admin\Auth\AuthController;
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

Route::prefix('auth')->as('auth.')->controller(AuthController::class)
    ->group(function ($route) {
        $route->post('login', 'login')->name('admin_login')->middleware('guest');
        $route->get('logout', 'logout')->name('admin_logout')->middleware('auth');
    });
