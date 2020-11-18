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

Route::get('get_students', 'API\CheckController@index');

Route::get('change_password', 'UserController@changepassword');
Route::post('change_password2', 'UserController@password')->name('change.password');

Route::post('get_matric', 'UserController@check')->name('get.matric');
Route::get('get_matric', 'UserController@check');

Route::get('on_start', 'AddonController@onstart');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('user', 'UserController');
    //Route::get('get_matric', 'UserController@check');

    Route::resource('election', 'ElectionController');

    Route::resource('nominee', 'NomineeController');

    Route::resource('position', 'PositionController');

    Route::get('vote/result', function () {
        return view('vote/backend/vue');
    })->name('vote.result');

});
