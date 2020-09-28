<?php

Route::get('/dashboard', 'UserDashboardController@index')->name('dashboard');

// Admin
Route::get('/profile', 'UserDashboardController@profile')->name('profile');
Route::get('/edit_profile', 'UserDashboardController@edit')->name('edit');
Route::patch('/edit_profile', 'UserDashboardController@update')->name('update');
Route::get('/change_password', 'UserDashboardController@change_password')->name('password_change');
Route::patch('/change_password', 'UserDashboardController@update_password')->name('change_password');
