<?php
/*
|--------------------------------------------------------------------------
| Voting Routes
|--------------------------------------------------------------------------
|
| This route is responsible for handling the Vote process
|
|
|
*/

Route::group(['middleware' => ['auth']], function () {

    Route::resource('user', 'UserController');
    Route::get('get_matric', 'UserController@check');

    Route::resource('election', 'ElectionController');

    Route::resource('nominee', 'NomineeController');

    Route::resource('position', 'PositionController');

    Route::get('vote/result', function () {
        return view('vote/backend/vue');
    })->name('vote.result');

});