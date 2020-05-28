<?php

use Illuminate\Support\Facades\Route;

Route::middleware( ['auth', 'roles'] )->group( static function(){
    Route::get( '/', 'DashboardController@index' )->name( 'home' );

    Route::get( '/dashboard', 'DashboardController@index' )->name( 'home' );

    Route::group( [ 'prefix' => 'dashboard' ], function(){
        Route::get( '/profile', [
            'uses' => 'UserController@profileIndex',
        ] )->name( 'users.profile' );

        Route::post( '/profileUpdate', [
            'uses' => 'UserController@profileUpdate'
        ] )->name( 'users.profileUpdate' );

        Route::post( '/passwordUpdate', [
            'uses' => 'UserController@passwordUpdate'
        ] )->name( 'users.passwordUpdate' );

    });
});