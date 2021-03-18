<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
// Route::middleware('auth:api')->post('/user', function (Request $request) {
//     return $request->user();
// });
//,'namespace' => 'Api\\'    
   //all Route/api here must be api authenticated
Route::group(['middleware' => ['api','checkPassword','changelanguage'],'namespace' => 'Api'], function(){
    
    //login & logout Route
    Route::group(['prefix' =>'users'], function(){
        Route::post('register', 'Auth\AuthController@register');
        Route::post('login','Auth\AuthController@login');
        Route::post('logout','Auth\AuthController@logout')->middleware('auth.guard:user-api');

    });
    //Group
    Route::get('group','Group\GroupsController@index');
    Route::get('group/{id}','Group\GroupsController@show');
    Route::post('addgroup','Group\GroupsController@store')->middleware('jwt.auth');
    Route::post('updategroup/{id}','Group\GroupsController@update')->middleware('jwt.auth');
    Route::delete('deletegroup/{id}','Group\GroupsController@destroy');




    //posts
    Route::get('posts','Post\PostsController@index');
    Route::get('posts/{id}','Post\PostsController@show');
    Route::post('addposts','Post\PostsController@store');
    Route::post('updatepost/{id}','Post\PostsController@update');
    Route::delete('deletepost/{id}','Post\PostsController@destroy');





    //category
    Route::post('category','Category\CategoryController@index');
    Route::post('category/{id}','Category\CategoryController@CategoryById');
    

});



// Route::group(['middleware'=>['api','checkuser'],'namespace'=>'Api'],function(){
    
// });

