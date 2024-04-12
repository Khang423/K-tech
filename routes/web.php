<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WardController;
use App\Http\Middleware\CheckLoginMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');

Route::group([
    'middleware' => CheckLoginMiddleware::class
], function() {
    Route::get('logout', [AuthController::class, 'logOut'])->name('logout');
    Route::resource('admin/members',MemberController::class)->except([
        'show',
    ]);
    Route::get('members/api', [MemberController::class, 'api'])->name('members.api');
    Route::get('members/api/name', [MemberController::class, 'apiName'])->name('members.api.name');

    Route::resource('admin/roles',RoleController::class)->except([
        'show',
    ]);

    Route::get('roles/api', [RoleController::class, 'api'])->name('roles.api');
    Route::get('roles/api/name', [RoleController::class, 'apiName'])->name('roles.api.name');

    // route cities
    Route::resource('address/cities',CityController::class)->except([
        'show',
    ]);
    Route::get('cities/api', [CityController::class, 'api'])->name('cities.api');
    Route::get('cities/api/name', [CityController::class, 'apiName'])->name('cities.api.name');
// route  districts
    Route::resource('address/districts',DistrictController::class)->except([
        'show',
    ]);
    Route::get('districts/api', [DistrictController::class, 'api'])->name('districts.api');
    Route::get('districts/api/name', [DistrictController::class, 'apiName'])->name('districts.api.name');
// route wards
    Route::resource('address/wards', WardController::class)->except([
        'show',
    ]);
    Route::get('wards/api', [WardController::class, 'api'])->name('wards.api');
    Route::get('wards/api/name', [WardController::class, 'apiName'])->name('wards.api.name');

});
