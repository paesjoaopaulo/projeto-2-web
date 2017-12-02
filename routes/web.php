<?php

Route::get('/noticias/s/{search?}', 'NoticiasController@search')->name('noticias.search');
Route::get('/noticias/sn/{search?}', 'NoticiasController@searchTitulo')->name('noticias.searchTitulo');
Route::get('/noticias', 'NoticiasController@index')->name('noticias.index');
Route::get('/noticias/create', 'NoticiasController@create')->name('noticias.create');
Route::get('/noticias/{noticia}', 'NoticiasController@show')->name('noticias.show');
Route::post('/noticias', 'NoticiasController@store')->name('noticias.store');

Route::get('/login', 'AuthController@login')->name('login');
Route::post('/login', 'AuthController@doLogin');

Route::get('/registro', 'AuthController@register')->name('registrar');
Route::post('/registro', 'AuthController@doRegister');

Route::post('/logout', 'AuthController@logout')->name('logout');

Route::get('/', 'HomeController@index');