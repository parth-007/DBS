<?php
Route::get('/','main\Main@index');
Route::get('login','main\Main@login');
Route::get('inspect','main\Main@inspect');
Route::get('admin/dashboard','admin\AdminDashboard@index');
Route::get('dashboard','client\ClientDashboard@index');

Route::get('admin/buildings','admin\AdminDashBoard@building');
Route::post('admin/buildings/insertbuilding','admin\AdminDashBoard@insert');
Route::get('admin/AdminDashBoard/fetch_account/{id}','admin\AdminDashBoard@fetch_account');
Route::post('admin/AdminDashBoard/status_change/','admin\AdminDashBoard@status_change');

Route::get('admin/buildings/delete/{id}','admin\AdminDashBoard@delete');

Route::get('admin/users','admin\AdminDashBoard@user');

Route::get('admin/resources','admin\AdminDashBoard@resource');
Route::post('admin/resources/insert','admin\AdminDashBoard@insertResource');
Route::get('admin/resourses/delete/{id}','admin\AdminDashBoard@deleteResource');
Route::post('admin/resources/update/','admin\AdminDashBoard@updateResource');
Route::get('admin/resources/fetchForUpdate/{update_id}','admin\AdminDashBoard@fetchForUpdate');