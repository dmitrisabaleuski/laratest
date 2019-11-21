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
Route::auth();
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/admin', 'AdminPanel@index');
Route::post('/', 'FeedbackController@create')->name('sendFeedback');
Route::get('/page_success', function(){
	return view('page_success');
});

Route::get('/admin/feedback-list', 'FeedbackController@index');
Route::get('/admin/feedback-{id}', 'FeedbackController@show')->name('feedbackShow');
Route::get('/admin/feedbackedit-{id}', 'FeedbackController@edit')->name('feedbackEdit');
Route::post('/admin/feedbackupdate{id}', 'FeedbackController@update')->name('feedbackUpdate');
Route::get('/admin/feedbackdelete-{id}', 'FeedbackController@destroy')->name('feedbackDelete');
