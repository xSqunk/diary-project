<?php

use Illuminate\Support\Facades\Route;

Route::middleware( ['auth', 'roles:student'] )->group( static function(){

    Route::group( [ 'prefix' => 'dashboard' ], static function(){

        Route::group( [ 'prefix' => 'grades' ], static function(){
            Route::get( '/my', [
                'uses' => 'GradeController@student'
            ] )->name( 'grades.student' );
        });

        Route::group( [ 'prefix' => 'notes' ], static function(){
            Route::get( '/my', [
                'uses' => 'NotesController@student'
            ] )->name( 'notes.student' );
        });
    });
});
