<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CollectionController;
use App\Http\Controllers\Api\CommissionController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\FavoriteController;
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
    Route::post('forgot-password', [AuthController::class, 'resetPasswordRequest']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);
    Route::post('update-profile', [AuthController::class, 'updateProfile']);
    Route::post('update-password', [AuthController::class, 'updatePassword']);
    Route::post('update-profile-picture', [AuthController::class, 'updateProfilePicture']);
});

Route::get('/post/search', [\App\Http\Controllers\Api\PostController::class, 'search']);
Route::post('/post/mostLiked', [\App\Http\Controllers\Api\PostController::class, 'mostLiked']);
Route::post('/post/mostViewed', [\App\Http\Controllers\Api\PostController::class, 'mostViewed']);
Route::apiResource('/post', \App\Http\Controllers\Api\PostController::class);
Route::get('/post/edit/{post}', [\App\Http\Controllers\Api\PostController::class, 'edit'])
    ->name('post.edit');
Route::get('/post/transaction/{post}', [PostController::class, 'buyArtPost']);
Route::get('/post/favorite/{post}', [\App\Http\Controllers\Api\PostController::class, 'addFavorite']);
Route::get('/post/unfavorite/{post}', [\App\Http\Controllers\Api\PostController::class, 'unFavorite']);
Route::get('/post/collected/{post}', [PostController::class, 'isCollected']);
Route::get('/post/favorited/{post}', [\App\Http\Controllers\Api\PostController::class, 'isFavorited']);
Route::get('/post/premium_download/{post}', [PostController::class, 'premiumDownload']);
Route::get('/post/by/{user_id}', [PostController::class, 'more_by']);


Route::get('/my-collection', [CollectionController::class, 'myCollection']);
Route::get('/my-favorite', [FavoriteController::class, 'myFavorite']);

Route::apiResource('/commission', \App\Http\Controllers\Api\CommissionController::class);
Route::get('/commission/edit/{commission}', [\App\Http\Controllers\Api\CommissionController::class, 'edit']);
Route::get('/commission/by/{user_id}', [CommissionController::class, 'more_by']);

Route::apiResource('/comment',\App\Http\Controllers\Api\CommentController::class);
Route::get('/comment/post/{post}',[\App\Http\Controllers\Api\CommentController::class, 'getComments']);
Route::post('/comment/commission',[\App\Http\Controllers\Api\CommentController::class, 'storeCommission']);
Route::get('/comment/commission/{commission}',[\App\Http\Controllers\Api\CommentController::class, 'getCommissionComments']);

Route::apiResource('/tags', \App\Http\Controllers\Api\TagController::class);

Route::post('/images', [ImageController::class, 'storeMany']);
Route::apiResource('/image', \App\Http\Controllers\Api\ImageController::class);
Route::get('/image/email/{email}', [ImageController::class, 'getProfileImageByEmail']);

Route::apiResource('/', \App\Http\Controllers\Api\GalleryController::class);

Route::get('/profile/{id}/posts', [\App\Http\Controllers\Api\PostController::class, 'getPostsPerAuthor']);

Route::get('/profile/{id}/commissions', [\App\Http\Controllers\Api\CommissionController::class, 'getCommissionPerAuthor']);

Route::get('/profile/{id}', [\App\Http\Controllers\Api\UserController::class, 'getUserProfile']);

Route::get('/sendmail', function (Request $request) {
    $ip = $request->ip();
    Mail::raw('Hi user, a new login into your account.', function ($message) {
        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        $message->to('artweeaboo@gmail.com', 'Weeaboo Art');
    });
});

