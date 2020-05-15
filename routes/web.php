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

Route::get('/', 'TopController@index');




Route::resource('users', 'UsersController');
Route::resource('news', 'NewsController')->only(['index','show']);
Route::resource('clippings', 'ClippingsController')->only(['index','show','destroy']);

Route::post('clippings/{folder_id}', 'ClippingsController@store')->name('clippings.store');

Route::resource('news_sites', 'NewsSitesController');


Route::resource('folders', 'FoldersController')->only(['store','destroy']);
Route::resource('comments', 'CommentsController')->only(['store','destroy']);


Route::post('favorites', 'FavoritesController@store')->name('favorites.store');


// Route::group(['middleware' => 'auth'], function() {
//     //
// });
