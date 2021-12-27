<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavouriteEventController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\CityController;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/', function () {
    return response(['message' => 'Fararooy API online'])->header('Content-type', 'application/json');
});

Route::middleware(['cors'])->prefix('/')->group(function () {
    Route::post('login', [APIController::class, 'authenticate']);
    Route::post('register', [APIController::class, 'register']);
    Route::post('logout', [APIController::class, 'logout']);
});

Route::middleware(['cors', 'jwt.verify'])->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'show']);
    Route::put('/', [UserController::class, 'update']);
    Route::delete('/', [UserController::class, 'destroy']);
    Route::post('/profile-image', [UserController::class, 'uploadProfileImage']);
    Route::get('/events', [UserController::class, 'getUserEvents']);
});

Route::middleware(['cors'])->prefix('events')->group(function () {
    Route::get('/show', [EventController::class, 'show']);
    Route::get('/latest', [EventController::class, 'getLatestEvents']);
    Route::get('/featured', [EventController::class, 'getFeaturedEvents']);
    Route::get('/', [EventController::class, 'index']);
});

Route::middleware(['cors', 'jwt.verify'])->prefix('favourite-events')->group(function () {
    Route::post('/add', [FavouriteEventController::class, 'addToFavourites']);
});

Route::middleware(['cors'])->prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::get('/latest', [PostController::class, 'getLatestPosts']);
});

Route::middleware(['cors'])->prefix('statistics')->group(function () {
    Route::get('/', [StatisticsController::class, 'index']);
});

Route::middleware(['cors'])->prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/top', [CategoryController::class, 'getTopCategories']);
});

Route::middleware(['cors'])->prefix('cities')->group(function () {
    Route::get('/', [CityController::class, 'index']);
});
