<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::group(array('before'=>'guest'), function() {
    Route::get('login', 'Account_IndexController@getAuthorization');
    Route::post('login', 'Account_IndexController@postAuthorization');
    Route::get('registration','Account_IndexController@getRegistration');
    Route::post('registration','Account_IndexController@postRegistration');
    Route::get('forgot-password','Account_IndexController@getForgotPassword');
    Route::post('forgot-password','Account_IndexController@postForgotPassword');
    Route::get('/confirm/{hash?}','Account_IndexController@getConfirmEmail');
    Route::post('/confirm/{hash?}','Account_IndexController@postConfirmEmail');
});

Route::group(array('before'=>'auth'), function(){
    Route::match(array("GET", "POST"),'/logout', 'Account_IndexController@getLogout');
});

Route::group(array('before'=>'auth','prefix'=>'account'), function(){
    Route::match(array("GET", "POST"),'/', 'Account_IndexController@index');
    Route::get('edit', 'Account_IndexController@getAuthorization');
    Route::post('edit', 'Account_IndexController@postAuthorization');
});



