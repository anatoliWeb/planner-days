<?php

Route::group(array('before'=>'auth','prefix'=>'tasks'), function(){
    Route::match(array("GET", "POST"),'/', 'Tasks_IndexController@index');
    Route::get('edit', 'Tasks_IndexController@getEdit');
    Route::post('edit', 'Tasks_IndexController@postEdit');
    Route::post('remove', 'Tasks_IndexController@postRemoveEvent');

    Route::get('events', 'Tasks_IndexController@postEvents');
    Route::post('events', 'Tasks_IndexController@postEvents');

    Route::get('edit-form', 'Tasks_IndexController@getEventForm');
    Route::post('edit-form', 'Tasks_IndexController@postEventForm');
    Route::post('edit-form', 'Tasks_IndexController@postEventAction');

    Route::post('edit-block', 'Tasks_IndexController@postEventBlock');
});
