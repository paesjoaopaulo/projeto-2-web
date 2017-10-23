<?php

Route::get('/noticias/q/{search?}', 'NoticiasController@search');
Route::resource('/noticias', 'NoticiasController');

Auth::routes();

Route::resource('/', 'HomeController');