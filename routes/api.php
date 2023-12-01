<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Questions\AnswerQuestionController;
use App\Http\Controllers\Api\Questions\GetDailyQuestionsController;
use App\Http\Controllers\Api\Users\GetUserController;
use App\Http\Controllers\Api\Users\ListUserController;
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
        Route::get('/', ListUserController::class)->name('index');

        Route::post('/', StoreUserController::class)->name('store');

        Route::get('/{user}', GetUserController::class)->name('show');
    });

Route::get('/questions/daily', GetDailyQuestionsController::class)->name('questions.daily');

Route::post('/{patient}/questions/answer', AnswerQuestionController::class)->name('questions.answer');
