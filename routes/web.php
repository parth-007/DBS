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
Route::get('request','client\Respond_Request@index');
Route::get('client_display','client\Client_Display@index');
Route::post('signup','client\Login_controller@signup');
Route::post('client/login','client\Login_controller@log_in');
Route::get('logout','client\Login_controller@log_out');
Route::post('dup_mail','ajax\Ajax@dup_mail_check');
Route::post('log_check','ajax\Ajax@log_info_check');
Route::get('sendbasicemail','client\Mail_Controller@basic_email');
