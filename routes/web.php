<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;


Route::resource('members',MemberController::class)->except([
    'show',
]);
Route::get('members/api', [MemberController::class, 'api'])->name('members.api');
Route::get('members/api/name', [MemberController::class, 'apiName'])->name('members.api.name');

