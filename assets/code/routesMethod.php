<?php
// Ancienne version
Route::post('activities/{id}/start', 'ActivityController@start');
Route::post('activities/{id}/hide', 'ActivityController@set_hidden');
Route::post('activities/{id}/show', 'ActivityController@set_visible');
Route::post('activities/{id}/delete', 'ActivityController@delete');
Route::post('activities/{id}/open', 'ActivityController@open');
Route::post('activities/{id}/close', 'ActivityController@close');

//Nouvelle version
Route::patch('/activities/{id}', [ActivityController::class, 'edit']);