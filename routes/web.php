<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::group(['prefix' => 'restaurant'],  function () {
        Route::get('/', 'RestaurantController@index')->name('restaurant.index');
        Route::get('create', 'RestaurantController@create')->name('restaurant.create');
        Route::post('store', 'RestaurantController@store')->name('restaurant.store');
        Route::get('show/{id?}', 'RestaurantController@show')->name('restaurant.show');
        Route::get('edit/{id?}', 'RestaurantController@edit')->name('restaurant.edit');
        Route::put('update', 'RestaurantController@update')->name('restaurant.update');
        Route::any('delete', 'RestaurantController@delete')->name('restaurant.delete');
    });
});
