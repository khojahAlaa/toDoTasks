<?php

use Illuminate\Http\Request;

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
// يمكن احتاجو ازا سارت بلاوي وطلبها من جديد Generating JWT Authentication Keys
// jwt-auth secret [5j6c8BCeKIZmQWoJRMz2tK1OHS70854ML9wLUruGhXu5sh7uEuaBxN8HDKZa18PS] set successfully.



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'API\APIController@login');
Route::post('register', 'API\APIController@register');


Route::apiResources(['user'=>'API\UserController']);
Route::get('rloes', 'API\ApiUserRoleController@index');


Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('jwt.auth')->group(function(){
    Route::get('my-tasks', 'API\ApiTaskController@myToDoTasks');

});

Route::get('profile/{id}', 'API\UserController@showProfile');
