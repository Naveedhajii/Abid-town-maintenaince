<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembersController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

//return home
Route::get('/home', 'MembersController@index')->name('home')->middleware('permission:view.members');

//for members
Route::get('/members', 'MembersController@index')->name('members')->middleware('permission:view.members');

Route::get('/members/create', 'MembersController@create')->name('create')->middleware('permission:create.members');

Route::post('/members/store', 'MembersController@createMember')->name('store')->middleware('permission:create.members');

Route::get('/members/edit/{member}', 'MembersController@edit')->name('edit')->middleware('permission:edit.members');

Route::put('/members/{member}','MembersController@update')->name('update')->middleware('permission:edit.members');

// Route::get('/members/delete/{member}','MembersController@delete')->name('member.delete')->middleware('permission:delete.members');

//for payments

Route::get('/invoice', 'InvoiceController@index')->name('invoice.index')->middleware('permission:view.invoices');

Route::get('/invoice/create', 'InvoiceController@create')->name('invoice.create')->middleware('permission:create.invoices');

Route::post('/invoice/create/{member}', 'InvoiceController@store')->name('invoice.store')->middleware('permission:create.invoices');

//for roles

Route::get('/roles','RoleController@index')->name('roles.index')->middleware('permission:view.roles');

Route::get('/roles/create', 'RoleController@create')->name('roles.create')->middleware('permission:create.roles');

Route::post('/roles/store', 'RoleController@store')->name('roles.store')->middleware('permission:create.roles');

Route::get('/roles/edit/{role}', 'RoleController@edit')->name('roles.edit')->middleware('permission:edit.roles');

Route::post('/roles/update/{role}', 'RoleController@update')->name('roles.update')->middleware('permission:edit.roles');

Route::get('/roles/delete/{role}', 'RoleController@delete')->name('roles.delete')->middleware('permission:delete.roles');

//for Users

Route::get('/users','UserController@index')->name('users.index')->middleware('permission:view.users');

Route::get('/users/create', 'UserController@create')->name('users.create')->middleware('permission:create.users');

Route::post('/users/store', 'UserController@store')->name('users.store')->middleware('permission:create.users');

Route::get('/users/edit/{user}', 'UserController@edit')->name('users.edit')->middleware('permission:edit.users');

Route::post('/users/update/{user}', 'UserController@update')->name('users.update')->middleware('permission:edit.users');

//invoice generation

Route::get('pdf/{member}/{payment}', array('as'=> 'generate.invoice.pdf', 'uses' => 'PDFController@generateInvoicePDF'));

//Report generation

Route::get('report/{member}', array('as'=> 'generate.invoice.pdf', 'uses' => 'PDFController@generateReportPDF'));

//for profile 
Route::get('/profile', 'ProfileController@index')->name('profile');

Route::put('/profile', 'ProfileController@update')->name('profile.update');

