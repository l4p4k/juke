<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

	// Route::get('/', function () {
 //        HomeController->index();
	//     return view('welcome');
	// });
    Route::auth();

    //Route::group(['middleware' => 'guest'], function () {
        Route::get('/', [
            'uses' => 'PostController@index',
            'as'   => 'home'
        ]);

        Route::get('/home', function(){
            return redirect()->route('home');
        });

        Route::get('/post/{id}', [
            'uses' => 'PostController@viewPost',
            'as' => 'post.view',
            function ($id = '1') {
        }]);

        Route::get('/profile/{id}', [
            'uses' => 'ProfileController@userProfile',
            'as' => 'userProfile',
            function ($id = null) {
        }]);

   //});

    Route::get('/profile', [
        'uses' => 'ProfileController@profile',
        'as' => 'profile'
    ]);

    Route::get('/profile/change', [
        'uses' => 'ProfileController@change',
        'as' => 'profile.change'
    ]);

    Route::get('/create', [
        'uses' => 'CreateController@create',
        'as' => 'create'
    ]);

    Route::get('/delete/{id}', [
            'uses' => 'PostController@deletePost',
            'as' => 'post.delete',
            function ($id = null) {
    }]);

    Route::post('/newpost', [
        'uses' => 'CreateController@postCreate',
        'as' => 'post.create'
    ]);
});

