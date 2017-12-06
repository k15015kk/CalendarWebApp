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
    return redirect('/home/month');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/month','HomeController@month');

Route::get('/home/month/{year}/{month}', 'HomeController@month')->where('yearmonth', '[0-9]+');

Route::get('/home/week/{year}/{month}/{day}','HomeController@week');

Route::get('/home/week','HomeController@week');
Route::get('/home/week/{year}/{month}/{day}','HomeController@week');

Route::get('/home/3days','HomeController@threedays');

Route::get('/home/3days/{year}/{month}/{day}','HomeController@threedays');

Route::get('/home/day','HomeController@day');

Route::get('/home/day/{year}/{month}/{day}','HomeController@day');

Route::get('/home/add','HomeController@add');

Route::post('/home/addSchedule','HomeController@addSchedule');

Route::get('/home/change/{id}','HomeCOntroller@change')->where('id', '[0-9]+');

Route::post('/home/changeSchedule','HomeController@changeSchedule');

Route::get('/home/delete/{id}','HomeController@delete')->where('id', '[0-9]+');