<?php

Route::get('/noticias/s/{search?}', 'NoticiasController@search')->name('noticias.search');
Route::resource('/noticias', 'NoticiasController');

Auth::routes();

Route::resource('/', 'HomeController');