<?php

// $this->view('/', 'initial')->name('home');
Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');