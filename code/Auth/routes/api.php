<?php

Route::post('register', 'Api\v1\RegisterController@index');
Route::post('login', 'Api\v1\LoginController@login');
