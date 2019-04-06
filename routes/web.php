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


Route::get('admin/resources','admin\AdminDashBoard@resource');
Route::get('admin/users','admin\AdminDashBoard@user');