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

Route::get('/', 'MainController@home')->name('home');
Route::get('/forum', 'MainController@index')->name('forum');
Route::get('/about','MainController@about')->name('about');
Route::get('/whatsnew','MainController@whatsnew')->name('whatsnew');
Route::get('/groups','MainController@groups')->name('groups');



Route::resource('/thread', 'ThreadController');
Route::resource('/comment', 'CommentController', ['only'=>['destroy', 'update']]);
Route::post('comment/create/{thread}', 'CommentController@addThreadComment')->name('threadcomment.store');
Route::post('reply/create/{comment}', 'CommentController@addReplyComment')->name('replycomment.store');

Route::post('/thread/mark-as-solution', 'ThreadController@markAsSolution')->name('markAsSolution');

Auth::routes();

Route::post('comment/like', 'LikeController@toggleLike')->name('toggleLike');

Route::get('/user/profile/{user}', 'UserProfileController@index')->name('user_profile');

Route::get('/markAsRead', function(){
	auth()->user()->unreadNotifications->markAsRead();
});

Route::get('admin/routes', 'HomeController@admin')->middleware('admin')->name('adminpage');
Route::get('admin/routes/users', 'HomeController@viewusers')->middleware('admin')->name('viewusers');
Route::delete('admin/routes/users/{id}', 'HomeController@destroy')->name('destroyuser');
Route::put('admin/routes/users/{id}', 'HomeController@update')->name('updateuser');

Route::put('admin/routes/password/{id}', 'HomeController@passwordupdate')->name('passwordupdate');
Route::get('admin/routes/topic/', 'HomeController@addtopic')->name('addtopic');
Route::delete('admin/routes/topic/{id}', 'HomeController@deletetopic')->name('deletetopic');
Route::delete('admin/routes/threads/{id}', 'HomeController@destroythread')->name('destroythread');
Route::delete('admin/routes/comments/{id}', 'HomeController@destroycomment')->name('destroycomment');
