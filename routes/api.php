<?php

use App\Http\Controllers\Api\Countrycontroller as ApiCountrycontroller;
use App\Http\Controllers\Api\Membercontroller as ApiMembercontroller;
use App\Http\Controllers\Api\Shop\Membercontroller;
use App\Http\Controllers\CountryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'/admin'],function(){
    Route::group(['prefix'=>'/country'],function(){
        Route::get('/', [ApiCountrycontroller::class, 'indexcountry']);
    });

});
Route::group(['prefix'=>'/shop'],function(){
    Route::group(['prefix'=>'/register-user'],function(){
        Route::post('/', [ApiMembercontroller::class, 'createuser']);
    });

});

