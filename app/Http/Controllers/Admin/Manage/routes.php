<?php

use App\Http\Controllers\Admin\Manage\Admin\AdminController;
use App\Http\Controllers\Admin\Manage\Role\RoleController;
use App\Http\Controllers\Admin\Manage\User\UserController;
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

Route::prefix('manage')->as('manage.')->middleware('auth')
    ->group(function ($route) {

        $route->prefix('user')->as('user.')->controller(UserController::class)->group(function ($route) {
            $route->get('/', 'index')->name('index');
            $route->post('/store', 'store')->name('store');
            $route->put('/update/{userId}', 'update')->name('update')->where('userId', '[0-9]+');
            $route->put('/update-status/{userId}', 'updateStatus')->name('update_status')->where('userId', '[0-9]+');
            $route->delete('/delete/{userId}', 'delete')->name('delete')->where('userId', '[0-9]+');
        });

        $route->prefix('admin')->as('admin.')->controller(AdminController::class)->group(function ($route) {
            $route->get('/', 'index')->name('index');
            $route->post('/store', 'store')->name('store');
            $route->put('/update/{adminId}', 'update')->name('update')->where('adminId', '[0-9]+');
            $route->put('/update-status/{adminId}', 'updateStatus')->name('update_status')->where('adminId', '[0-9]+');
            $route->delete('/delete/{adminId}', 'delete')->name('delete')->where('adminId', '[0-9]+');
        });

        $route->prefix('role')->as('role.')->controller(RoleController::class)->group(function ($route) {
            $route->get('/', 'index')->name('index');
            $route->get('/role-list', 'roleList')->name('role_list');
            $route->post('/store', 'store')->name('store');
            $route->put('/update/{userId}', 'update')->name('update')->where('userId', '[0-9]+');
            $route->delete('/delete/{userId}', 'delete')->name('delete')->where('userId', '[0-9]+');
        });
    });
