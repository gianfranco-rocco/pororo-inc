<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Users\StoreUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('users')
    ->name('users.')
    ->group(function () {
        Route::post('/', StoreUserController::class)->name('store');
    });
