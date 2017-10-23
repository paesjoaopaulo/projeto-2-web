<?php

Route::resource('/noticias', 'NoticiasController');
Route::get('/noticias/{search?}', 'NoticiasController@search')->name('noticias.search');

Auth::routes();

Route::resource('/', 'HomeController');