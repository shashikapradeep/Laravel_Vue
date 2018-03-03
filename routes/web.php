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
Route::get('/admin', function () {
    return view('admin/home');
});

Route::get('/admin/about', function () {
    return view('admin/home');
});

Route::get('/admin/graph', function () {
    return view('admin/home');
});


Route::get('/admin/graph/onboarding', 'Admin\GraphController@onBoarding');
