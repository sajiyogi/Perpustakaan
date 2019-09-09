<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');
    Route::post('buku', function(Request $request) {
    $buku = $request->all();
        return Buku::create([
            'judul' => $buku['judul'],
            'image' => $buku['image'],
            'pengarang' => $buku['pengarang'],
            'penerbit' => $buku['penerbit'],
            'jumlah' => $buku['jumlah'],
        ]);
});

    Route::apiResource('products', 'ProductsApiController');
    Route::apiResource('rules', 'RulesApiController');
    Route::apiResource('buku', 'BukuApiController');
});
