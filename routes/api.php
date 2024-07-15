<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'v1'
], function ($router) {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::post('refresh', [UserController::class, 'refresh']);
    Route::get('user-profile', [UserController::class, 'profile']);    
    Route::put('editProfile/{id}', [UserController::class, 'editProfile']);
    Route::post('change-password', [UserController::class, 'changePassword']);

});


Route::prefix('endpoint/v1')->group(function () {

    Route::get('courses', [CourseController::class, 'index']);
    Route::get('courses/{course_id}/curriculums', [CurriculumController::class, 'index']);
    Route::get('advertisements', [AdvertisementController::class, 'index']);
    Route::get('articles', [ArticleController::class, 'index']);

});