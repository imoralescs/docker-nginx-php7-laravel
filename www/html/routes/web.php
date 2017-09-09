<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Basic Route
/*
Route::get('users/{id}', function($id){
  echo $id;
});
*/

// Group Route
Route::group(['prefix' => 'account'], function(){
  Route::get('change-password', function(){
    echo 'Change password';
  });

  Route::get('profile', function(){
    echo 'Profile';
  });

  Route::post('profile', function(){
    //
  });
});

// Naming Route
Route::get('/redirect', function(){
  return redirect()->route('landing');
});

Route::get('/landing/page', function(){
  echo 'Landing';
})->name('landing');

// Hook Up Route and Controller
Route::get('/home',[
  // as mean route name.
  'as' => 'home',
  // uses controller and define as ControllerName@functionInController
  'uses' => 'HomeController@index',
]);
/*
Route::post('/home',[
  'uses' => 'HomeController@create'
]);
*/

// Passing data from router to controller and view
Route::get('/users/{username}',[
  'uses' => 'HomeController@user'
]);
