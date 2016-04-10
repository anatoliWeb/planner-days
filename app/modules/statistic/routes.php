<?php

Route::group(array('before'=>'auth','prefix'=>'statistic'), function(){
    Route::match(array("GET", "POST"),'/', 'Tasks_IndexController@index');
});
