<?php

use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\ActionsController;
use App\Http\Controllers\UserController;

Route::get('/', [ViewsController::class,'index'])
    -> name('site.index');

Route::get('/register', [ViewsController::class, 'register'])
    -> name('site.register')
    -> middleware('guest');

Route::post('/register', [ActionsController::class, 'register'])
    -> middleware('guest');

Route::get('/exit', [ActionsController::class,'logout'])
    ->name('site.logout')
    ->middleware('auth');

Route::get('/login', [ViewsController::class,'login'])
    ->name('site.login')
    ->middleware('guest');

Route::post('/login', [ActionsController::class,'login'])
    ->middleware('guest');

Route::get('/music/load', [ViewsController::class,'load_music'])
    ->name('music.create')
    ->middleware('auth');

Route::post('/music/load', [ActionsController::class,'load_music'])
    ->middleware('auth');

Route::get('/search-tracks', [SearchController::class, 'search'])
    ->name('search.tracks');

Route::get('/user/{id}', [ActionsController::class, 'show'])
    ->name('user.profile');

Route::get('/profile/{id}', [ActionsController::class,'profile'])
    ->name('site.profile');

Route::post('/music/{musicId}/like', [ActionsController::class, 'set_like'])
    ->name('music.like');
Route::delete('/music/{musicId}/like', [ActionsController::class, 'destroy_like'])
    ->name('music.unlike');
