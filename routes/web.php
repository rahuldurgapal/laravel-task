<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\UserMiddleware;

Route::get('/', function () {
    return view('welcome');
});

//Route for viewing registration page
Route::get('/register',[UserController::class,'showRegister'])->name('register');

//Route for register user in database
Route::post('/registerSave',[UserController::class,'register'])->name('registerSave');

//Route for viewing login page
Route::get('/login',[UserController::class,'showLogin'])->name('login');

//Route for validate the user request
Route::post('/loginUser',[UserController::class,'login'])->name('loginUser');

//Route for logout the user
Route::get('/logout',[UserController::class,'logout'])->name('logout');


//Route for enter dashboard page after successfull login
Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard')->middleware(UserMiddleware::class);