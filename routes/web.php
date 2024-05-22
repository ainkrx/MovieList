<?php

use App\Http\Controllers\ActorController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
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

Route::get('/', [Controller::class, 'index']);
Route::get('/movies', [MovieController::class, 'viewMovies']);
Route::get('/movies/view/{id}', [MovieController::class, 'movieDetails']);
Route::get('/actors', [ActorController::class, 'viewActors']);
Route::get('/actors/view/{id}', [ActorController::class, 'actorDetails']);

Route::group(['middleware' => 'guestsecurity'], function () {
    Route::get('/loginPage', [UserController::class, 'viewLogin']);
    Route::get('/registerPage', [UserController::class, 'viewRegister']);

    Route::post('/loginPage', [UserController::class, 'login']);;
    Route::post('/registerPage', [UserController::class, 'register']);
});

Route::group(['middleware' => 'loggedinsecurity'], function () {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/profile/edit', [UserController::class, 'edit']);

    Route::post('/profile/editData', [UserController::class, 'editData']);
    Route::post('/profile/editImage', [UserController::class, 'editImage']);
});

Route::group(['middleware' => 'membersecurity'], function () {
    Route::get('/watchlists', [UserController::class, 'watchlists']);
    Route::get('/watchlists/add/{id}', [UserController::class, 'addMovieToWatchlist']);
    Route::get('/watchlists/remove/{id}', [UserController::class, 'removeMovieFromWatchlist']);

    Route::post('/watchlists/changeStatus', [UserController::class, 'changeStatus']);
});

Route::group(['middleware' => 'adminsecurity'], function () {
    Route::get('/movies/add', [MovieController::class, 'createMovie']);
    Route::get('/actors/add', [ActorController::class, 'createActor']);
    Route::get('/movies/edit/{id}', [MovieController::class, 'editMovie']);
    Route::get('/actors/edit/{id}', [ActorController::class, 'editActor']);
    Route::get('/movies/remove/{id}', [MovieController::class, 'removeMovie']);
    Route::get('/actors/remove/{id}', [ActorController::class, 'removeActor']);

    Route::post('/movies/add', [MovieController::class, 'insertMovie']);
    Route::post('/actors/add', [ActorController::class, 'insertActor']);
    Route::post('/movies/editData/{id}', [MovieController::class, 'editDataMovie']);
    Route::post('/actors/editData/{id}', [ActorController::class, 'editDataActor']);
});
