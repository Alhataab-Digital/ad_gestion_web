<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\ProfileController;
use App\Http\Controllers\Api\Auth\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function(Request $request) {
    return $request->user();
});

Route::get('/test', function(){
    return response ([
        'message'=>"Api is working"
    ], 200);
});
Route::controller(LoginController::class)->group(function(){
    Route::get('/','login');
    Route::post('/auth','store');
    Route::get('/logout','logout');
});
Route::controller(RegisterController::class)->group(function(){

    Route::get('/registre/list','index');
    Route::post('/registre','store');

});

Route::middleware('auth:sanctum')->controller(UserController::class)->group(function(){
    Route::get('/users/index','index');
    Route::post('/users/store','store');
    Route::get('/users/{id}/edit','edit');
    Route::post('/users/{id}/update','update');
    Route::get('/users/{id}/active','active');
    Route::get('/users/{id}/inactive','inactive');
    Route::post('/users/{id}/role','role');
    Route::post('/users/{id}/password','password');
    Route::post('/users/permission','permission');
});