<?php

Auth::routes();

Route::namespace('Client')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::get('/detail/{id}', 'BookController@detail')->name('detail');
    Route::resources([
        'borrows' => 'BorrowController',
        'likes' => 'LikeController',
        'comments' => 'CommentController'
    ]);
});

Route::prefix('cart')->group(function () {
    Route::post('/add-item', 'Client\CartController@addItem');
    Route::delete('/delete-item', 'Client\CartController@deleteItem');
    Route::get('/list', 'Client\CartController@showListItems')->name('list.carts');
});

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin'], function () {

        Route::get('/', 'Admin\DashboardController@index')->name('dashboard');
        Route::get('/chart', 'Admin\DashboardController@chart');
        Route::resources([
            'borrow' => 'Admin\BorrowController',
            'author' => 'Admin\AuthorController',
            'publisher' => 'Admin\PublisherController',
            'book' => 'Admin\BookController'
        ]);

        Route::get('author/export/excel', 'Admin\AuthorController@export')->name('author.export');
        Route::get('publisher/export/excel', 'Admin\PublisherController@export')->name('publisher.export');
        Route::get('book/export/excel', 'Admin\BookController@export')->name('book.export');
    });
});
Route::get('login/{provider}', 'Auth\LoginSocialiteController@redirectToProvider')->name('login.provider');
Route::get('login/{provider}/callback', 'Auth\LoginSocialiteController@handleProviderCallback');

