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

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', 'TopController@index')->name('top');

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    Route::get('news/print', 'NewsController@print')->name('news.print');
    Route::get('clippings/print', 'ClippingsController@print')->name('clippings.print');
    
    
    Route::resource('users', 'UsersController');
    Route::resource('news', 'NewsController')->only(['index','show']);
    
    
    Route::resource('clippings', 'ClippingsController')->only(['index','store','show']);
    Route::delete('clippings', 'ClippingsController@destroy')->name('clippings.destroy');
    
    // Route::post('clippings/{folder_id}', 'ClippingsController@store')->name('clippings.store');
    
    Route::resource('news_sites', 'NewsSitesController');
    
    
    Route::resource('folders', 'FoldersController')->only(['store']);
    Route::delete('folders', 'FoldersController@destroy')->name('folders.destroy');
    Route::resource('comments', 'CommentsController')->only(['store','destroy']);
    
    
    Route::post('favorites', 'FavoritesController@store')->name('favorites.store');
});



// Route::get('/home', 'HomeController@index')->name('home');
