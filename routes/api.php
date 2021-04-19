<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;


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

    // Route::get('user', function(){
    //     return \Auth::user();
    // });

    Route::get('test', function () {
        return response()->json('OK', 200);
    });

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});



Route::resource('user', UserController::class);


// Route::post('/login', 'AuthController@login')->middleware('cors');
