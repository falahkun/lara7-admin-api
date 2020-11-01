<?php

use App\Http\Controllers\ResponseHelper;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::prefix('oauth')->group(function() {
//     // Route::get('login', 'API\AuthController@getResponseProvider')->middleware('provider');
    
// });

Route::prefix('v1')->group(function() {
    Route::prefix('auth')->group(
        function() {
            Route::post('register', 'API\AuthController@createUser');
            Route::post('login', 'API\AuthController@login');
            Route::get('user', 'API\AuthController@getUser')->middleware('auth:api');
        }
    );
    Route::middleware('auth:api')->group(function() {
        Route::get('/', function() {
            return array('greeting' => 'welcome');
        });
        
    });
    
});

Route::fallback(function(){
    return ResponseHelper::response(404, null, "404 | Not Found");
});

// Route::post('register', 'API\AuthController@createUser');
// Route::post('register', 'API\AuthController@testing');
