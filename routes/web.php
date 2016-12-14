<?php

// don't need the following
//use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('marketingimage', 'MarketingImageController');

Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index');

Route::get('/test', function () {
	// Get the currently authenticated user...
	$user = Auth::user();

	// Get the currently authenticated user's ID...
	$id = Auth::id();
	$name = Auth::user()->name;
	echo("id = ".$id." name = ".$name);
	if(Auth()) {
		echo($name." is logged in.");
	}

	dd(Auth::user());
});

Route::get('/test2', function () {
    echo("we are authenticated.");
})->middleware('auth');

Route::get('/show-login-status', function() {

    # You may access the authenticated user via the Auth facade
    $user = Auth::user();

    if($user)
        dump($user->toArray());
    else
        dump('You are not logged in.');

    return;
});
