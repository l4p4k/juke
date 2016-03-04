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
    Route::get('/', [
        'uses' => 'PostController@index',
        'as' => 'home'
    ]);
    Route::get('post/{id}', function($id){
    	$post = App\Post::find($id);
    	echo $post->title;
    	echo "<br>";
    	echo $post->comment;
    });
    Route::get('/profile', 'ProfileController@profile');
    Route::get('/create', 'CreateController@create');
    Route::post('/newpost', [
        'uses' => 'CreateController@postCreate',
        'as' => 'post.create'
    ]);
});
