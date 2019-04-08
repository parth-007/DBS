<?php
Route::get('/','main\Main@index');
Route::get('login','main\Main@login');
Route::get('inspect','main\Main@inspect');
Route::get('admin/dashboard','admin\AdminDashboard@index');
Route::get('dashboard','client\ClientDashboard@index');
Route::get('client/booking','client\ClientDashboard@book');
Route::any('client/show_slots','client\ClientDashboard@show_slots');

Route::get('profile','client\ClientDashboard@userProfile');
Route::post('updateProfile','client\ClientDashboard@updateProfile');
Route::get('request','client\Respond_Request@index');
Route::get('client_display','client\Client_Display@index');
Route::post('signup','client\Login_controller@signup');
Route::post('client/login','client\Login_controller@log_in');
Route::get('logout','client\Login_controller@log_out');
Route::post('dup_mail','ajax\Ajax@dup_mail_check');
Route::post('log_check','ajax\Ajax@log_info_check');
Route::get('sendbasicemail','client\Mail_Controller@basic_email');
Route::get('admin/login','admin\admin_login_controller@index');
Route::post('admin/log_check','ajax\Ajax@admin_log_info_check');
Route::get('admin/buildings','admin\AdminDashBoard@building');
Route::post('admin/buildings/insertbuilding','admin\AdminDashBoard@insert');
Route::get('admin/AdminDashBoard/fetch_account/{id}','admin\AdminDashBoard@fetch_account');
Route::post('admin/AdminDashBoard/status_change/','admin\AdminDashBoard@status_change');//INM 06-04-2019
Route::post('admin/AdminDashBoard/showHint/','admin\AdminDashBoard@showHint');//INM 06-04-2019
Route::get('admin/buildings/delete/{id}','admin\AdminDashBoard@delete');
Route::get('admin/users','admin\AdminDashBoard@user');
Route::get('admin/disableusers','admin\AdminDashBoard@disableusers');// INM 07-04-2019
Route::POST('admin/AdminDashBoard/showBySearchPattern/','admin\AdminDashBoard@showBySearchPattern');// INM 07-04-2019
Route::POST('admin/AdminDashBoard/multiplestudentstatusupdate/','admin\AdminDashBoard@multiplestudentstatusupdate');// INM 07-04-2019
Route::get('admin/resources','admin\AdminDashBoard@resource');
Route::post('admin/resources/insert','admin\AdminDashBoard@insertResource');
Route::get('admin/resourses/delete/{id}','admin\AdminDashBoard@deleteResource');
Route::post('admin/resources/update/','admin\AdminDashBoard@updateResource');
Route::get('admin/resources/fetchForUpdate/{update_id}','admin\AdminDashBoard@fetchForUpdate');
?>
