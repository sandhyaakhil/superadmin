<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['prevent-back-history']], function () {

  Route::get('/login', function () {
      return view('auth.login');
  });

//Auth::routes();
//
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/login', 'ApiController@login')->name('login');
Route::post('/logout', 'ApiController@logout')->name('logout');
//Settings
 Route::post('/choose_client/{id}', 'SettingsController@selectClient')->name('admin.client.select');
 Route::get('/configurations/{section}', 'SettingsController@configurations')->name('admin.settings.configurations');
 Route::post('/save_configurations/{id}', 'SettingsController@save_configurations')->name('admin.settings.save_configurations');
 Route::post('/save_payment_settings/{id}', 'SettingsController@save_payment_settings')->name('admin.payment_settings.save_configurations');
 Route::post('/save_social_settings/{id}', 'SettingsController@save_social_settings')->name('admin.social_settings.save_configurations');
 Route::post('/save_auth_settings', 'SettingsController@save_auth_settings')->name('admin.auth_settings.save_configurations');
 Route::post('/save_courier_settings/{id}', 'SettingsController@save_courier_settings')->name('admin.courier_settings.save_configurations');
 Route::post('/save_category_settings', 'SettingsController@save_category_settings')->name('admin.category_settings.save_configurations');
 Route::post('/save_address_settings/{id}', 'SettingsController@save_address_settings')->name('admin.address_settings.save_configurations');
 Route::post('/save_email_settings/{id}', 'SettingsController@save_email_settings')->name('admin.email_settings.save_configurations');
 Route::post('/save_sms_settings/{id}', 'SettingsController@save_sms_settings')->name('admin.sms_settings.save_configurations');
 Route::post('/save_footer_settings/{id}', 'SettingsController@save_footer_settings')->name('admin.footer_settings.save_configurations');
 Route::post('/save_chat_settings/{id}', 'SettingsController@save_chat_settings')->name('admin.chat_settings.save_configurations');
 Route::post('/save_whatsapp_settings/{id}', 'SettingsController@save_whatsapp_settings')->name('admin.whatsapp_settings.save_configurations');
 Route::post('/save_email_template_settings/{id}', 'SettingsController@save_email_template_settings')->name('admin.email_template_settings.save_configurations');

 Route::get('/', function () {
     return view('auth.login');
 });


});
