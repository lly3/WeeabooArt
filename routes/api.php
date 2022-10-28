<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/rewards/search', [\App\Http\Controllers\Api\RewardController::class, 'search']);
Route::get('/reward_codes/search', [\App\Http\Controllers\Api\RewardCodeController::class, 'search']);
Route::apiResource('/rewards', \App\Http\Controllers\Api\RewardController::class);
Route::apiResource('/reward_codes', \App\Http\Controllers\Api\RewardCodeController::class);

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::post('/post/mostLiked', [\App\Http\Controllers\Api\PostController::class, 'mostLiked']);
Route::post('/post/mostViewed', [\App\Http\Controllers\Api\PostController::class, 'mostViewed']);
Route::apiResource('/post', \App\Http\Controllers\Api\PostController::class);
Route::get('/post/edit/{post}', [\App\Http\Controllers\Api\PostController::class, 'edit'])
    ->name('post.edit');
Route::get('/post/transaction/{post}', [PostController::class, 'buyArtPost']);
Route::get('/post/collected/{post}', [PostController::class, 'isCollected']);
Route::get('/post/premium_download/{post}', [PostController::class, 'premiumDownload']);
Route::get('/post/by/{user_id}', [PostController::class, 'more_by']);

Route::apiResource('/commission', \App\Http\Controllers\Api\CommissionController::class);
Route::get('/commission/edit/{commission}', [\App\Http\Controllers\Api\CommissionController::class, 'edit']);

Route::apiResource('/tag', \App\Http\Controllers\Api\TagController::class);

Route::post('/images', [ImageController::class, 'storeMany']);
Route::apiResource('/image', \App\Http\Controllers\Api\ImageController::class);
Route::get('/image/email/{email}', [ImageController::class, 'getProfileImageByEmail']);

Route::apiResource('/', \App\Http\Controllers\Api\GalleryController::class);
