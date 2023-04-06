<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*                                               *\
    #####------->   API ROUTES  <---------#####   
\*                                               */



//__Protectd 
Route::middleware('auth:sanctum')->group(function() { 
    Route::post('/products',[ProductController::class, 'store']);
    Route::delete('/products/{id}',[ProductController::class, 'delete']);
    Route::post('/logout',[AuthController::class, 'logout']);
});


//___public routes

Route::get('/products',[ProductController::class, 'index']);
Route::post('/login',[AuthController::class, 'login']);
Route::post('/register',[AuthController::class, 'store']);



