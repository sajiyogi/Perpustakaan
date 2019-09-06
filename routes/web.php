<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');
    Route::delete('rules/destroy', 'RulesController@massDestroy')->name('rules.massDestroy');

    Route::resource('rules', 'RulesController');

    Route::resource('buku', 'BukuController');
    Route::delete('buku/destroy', 'BukuController@massDestroy')->name('buku.massDestroy');

    Route::resource('book', 'BookController');

    Route::resource('kategoribuku', 'KategoribukuController');
});
