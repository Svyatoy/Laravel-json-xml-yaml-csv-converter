<?php

Route::get('form', function () {
    return view('converter.form');
});

Route::post('converter', 'ConverterController@storeFile')->name('converter');

Route::get('/', function () {
    return view('welcome');
});


