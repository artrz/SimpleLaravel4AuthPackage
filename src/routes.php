<?php

$sessionController = 'Allegro\Auth\Controller\SessionController';
$userController    = 'Allegro\Auth\Controller\UserController';

/**
* Checks if the user is logged
*/
Route::filter('sentry.auth', function()
{
    if (!Sentry::check()) {
        Session::put('loginRedirect', Request::url());
        return Redirect::route('user_login_show');
    }
});

// // // // // // // // // // // // // // // // // // // // // // Session routes

Route::get('login', [
    'as'         => 'user_login_show',
    'uses'       => "$sessionController@create"
]);

Route::post('login', [
    'as'         => 'user_login_action',
    'uses'       => "$sessionController@store"
]);

Route::get('logout', [
    'as'         => 'user_logout',
    'uses'       => "$sessionController@destroy"
]);

// // // // // // // // // // // // // // // // // // // // // // // User routes

Route::get('register', [
    'as'         => 'user_register_show',
    'uses'       => "$userController@create"
]);

Route::post('register', [
    'as'         => 'user_register_action',
    'uses'       => "$userController@store"
]);

Route::get('user/edit', [
    'before'     => 'sentry.auth',
    'as'         => 'user_edit_show',
    'uses'       => "$userController@edit"
]);

Route::post('user/edit', [
    'before'     => 'sentry.auth',
    'as'         => 'user_edit_action',
    'uses'       => "$userController@update"
]);

Route::get('user/delete', [
    'before'     => 'sentry.auth',
    'as'         => 'user_delete',
    'uses'       => "$userController@destroy"
]);
