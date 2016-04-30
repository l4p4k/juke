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
    Route::auth();

    Route::get('/', [
        'uses' => 'PostController@index',
        'as'   => 'home'
    ]);

    Route::get('/post/{id}', [
        'uses' => 'PostController@viewPost',
        'as' => 'post.view',
        function ($id = '1') {
    }]);

    Route::post('/rate', [
        'uses' => 'SubscriptionController@rate',
        'as' => 'sub.rate'
    ]);

    Route::get('/subscribe/{post_id}', [
        'uses' => 'SubscriptionController@sub',
        'as' => 'sub.sub',
        function ($id = null) {
    }]);

    Route::get('/profile/change', [
        'uses' => 'ProfileController@change',
        'as' => 'profile.change'
    ]);

    Route::get('/create', [
        'uses' => 'CreateController@create',
        'as' => 'create'
    ]);

    Route::post('/newpost', [
        'uses' => 'CreateController@postCreate',
        'as' => 'post.create'
    ]);

    Route::get('/delete/{id}', [
        'uses' => 'PostController@deletePost',
        'as' => 'post.delete',
        function ($id = null) {
    }]);

    Route::get('/delete', [
        'uses' => 'PostController@deleteError',
        'as' => 'deleteError'
    ]);

    Route::get('/profile/{id}', [
        'uses' => 'ProfileController@userProfile',
        'as' => 'userProfile',
        function ($id = null) {
    }]);

    Route::get('/profile', [
        'uses' => 'ProfileController@profile',
        'as' => 'profile'
    ]);

    Route::get('/messages', [
        'uses' => 'MessageController@index',
        'as' => 'messages'
    ]);

    Route::post('/new_message', [
        'uses' => 'MessageController@create',
        'as' => 'messages.create'
    ]);

    Route::get('/subs', [
        'uses' => 'SubscriptionController@subs',
        'as' => 'subs'
    ]);

    Route::post('/editProfile', [
        'uses' => 'ProfileController@editProfile',
        'as' => 'profile.edit'
    ]);

    Route::get('/simple_search', [
        'uses' => 'PostController@simple_search',
        'as' => 'simple_search'
    ]);

    Route::get('/extra_search', [
        'uses' => 'PostController@simple_search',
        'as' => 'extra_search'
    ]);

    Route::get('/showPostJobTypes/{jobType}', [
        'uses' => 'PostController@showPostJobTypes',
        'as' => 'showPostJobTypes',
        function ($jobType = "None") {
    }]);

    Route::get('/error', [
        'as' => 'error',
        function () {
        $data = "We have an error!";
        return view('error')->withdata($data);
    }]);

});

