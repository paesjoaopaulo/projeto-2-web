<?php

Route::resource('/noticias', 'NoticiasController');

Auth::routes();

Route::resource('/', 'HomeController');