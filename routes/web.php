<?php

/**
 * User routes
 */
Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('home');
});


/**
 * Admin Routes
 */
Route::get('/Admin', function () {
    return view('Admin/home');
});

Route::get('/Admin/about', function () {
    return view('Admin/home');
});


Route::get('/admin/graph/onboarding', 'Admin\GraphController@onBoarding');
