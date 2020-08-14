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

Route::get('/', function(){
	return Redirect('/login');
});

Auth::routes();

////////////////////////////////////////////////////////////////////////
//Beranda
Route::get('/beranda', dd('x'));
Route::get('/biodata', 'BerandaController@biodata');
Route::get('/ganti_password', 'BerandaController@gantiPassword');
Route::post('/ganti_password', 'BerandaController@storePasswordBaru');
Route::post('/biodata', 'BerandaController@storeBiodata');
Route::resource('/prestasi', 'PrestasiController');
Route::resource('/organisasi', 'OrganisasiController');

////////////////////////////////////////////////////////////////////////
//Admin
Route::get('/admin/beranda', 'AdminController@index');
Route::get('/admin/mahasiswa', 'AdminController@mahasiswa');
Route::get('/admin/biodata/{id}', 'AdminController@biodata');
Route::get('/admin/log/{id}', 'AdminController@log');
Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\LoginController@login');
Route::get('/sss', 'Admin\LoginController@sss');
Route::post('/admin/logout', 'Admin\LoginController@logout')->name('admin.logout');