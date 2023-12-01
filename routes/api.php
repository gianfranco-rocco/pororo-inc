<?php

declare(strict_types=1);

use App\Http\Controllers\Api\Conversations\CloseConversationController;
use App\Http\Controllers\Api\Conversations\GetCareReceiverDailyReport;
use App\Http\Controllers\Api\Conversations\GetMessagesController;
use App\Http\Controllers\Api\Conversations\StoreConversationController;
use App\Http\Controllers\Api\Conversations\StoreMessageController;
use App\Http\Controllers\Api\Questions\AnswerQuestionController;
use App\Http\Controllers\Api\Questions\GetDailyQuestionsController;
use App\Http\Controllers\Api\Users\GetUserController;
use App\Http\Controllers\Api\Users\ListUserController;
use App\Http\Controllers\Api\Users\StoreUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ThreeWordQAndA\StoreGameController;
use App\Http\Controllers\Api\ThreeWordQAndA\UpdateWithUserAnswersController;

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
    ->group(static function () {
        Route::get('/', ListUserController::class)->name('index');

        Route::post('/', StoreUserController::class)->name('store');

        Route::get('/{user}', GetUserController::class)->name('show');
    });

Route::prefix('conversations')
    ->name('conversations.')
    ->group(static function () {
        Route::get('/{caregiver}/daily-report', GetCareReceiverDailyReport::class)->name('user.daily-report');

        Route::post('/{user}', StoreConversationController::class)->name('store');

        Route::put('/{conversation}/close', CloseConversationController::class)->name('close');

        Route::prefix('messages/{conversation}')
            ->name('messages.')
            ->group(static function () {
                Route::get('/', GetMessagesController::class)->name('index');

                Route::post('/', StoreMessageController::class)->name('store');
            });
    });

Route::prefix('questions')
    ->name('questions.')
    ->group(static function () {
        Route::get('/daily', GetDailyQuestionsController::class)->name('daily');

        Route::post('/{patient}/answer', AnswerQuestionController::class)->name('answer');
    });

Route::prefix('game')
    ->name('game.')
    ->group(static function () {
        Route::get('/{user}', StoreGameController::class);

        Route::post('/{game}', UpdateWithUserAnswersController::class);
    });
