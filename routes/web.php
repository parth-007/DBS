<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','main\Main@index');
Route::get('login','main\Main@login');
Route::get('inspect','main\Main@inspect');
Route::get('admin/dashboard','admin\AdminDashboard@index');
Route::get('dashboard','client\ClientDashboard@index');
Route::get('admin/buildings','admin\AdminDashBoard@building');
Route::get('admin/users','admin\AdminDashBoard@user');

Route::get('admin/resources','admin\AdminDashBoard@resource');
Route::post('admin/resources/insert','admin\AdminDashBoard@insertResource');
Route::get('admin/resourses/delete/{id}','admin\AdminDashBoard@deleteResource');
Route::get('admin/resourses/update/{id}','admin\AdminDashBoard@updateResource');