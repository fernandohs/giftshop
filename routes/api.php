<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;


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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => ['cors', 'auth:sanctum', 'token.lifetime']], function () {
    Route::get('test', function () {
        return response()->json('OK', 200);
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('user', UserController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('sale', SaleController::class);
    Route::resource('product', ProductController::class);
});
