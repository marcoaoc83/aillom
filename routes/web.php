<?php

use App\Http\Controllers\SocialiteAuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/admin/oauth/callback/govbr', [SocialiteAuthController::class, 'handleGovbrCallback']);
Route::get('/web/oauth/callback/govbr', [SocialiteAuthController::class, 'handleGovbrCallback']);

