<?php

// namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiCategories;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



// Route::resource('/api_category', ApiCategory::class);
// Route::get('/api_category', [ApiCategory::class, 'index']);
// http://127.0.0.1:8000/api_category

// Route::resource('/api_category', ApiCategories::class);
Route::get('/api_categories', [ApiCategories::class, 'index']);
