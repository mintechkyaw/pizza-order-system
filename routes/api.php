<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return Auth::user()->name;
});


Route::get('apitest',function() {
    return [
        'title' => 'API Test',
        'msg' => 'hello this is api test!'
    ];
});

Route::get('category/index',[ApiController::class,'index']);


Route::post('category/create',[ApiController::class,'store']);

Route::get('category/show/{id}',[ApiController::class,'show']);
Route::post('category/update/{id}',[ApiController::class,'update']);
Route::post('category/delete/{id}',[ApiController::class,'destroy']);
