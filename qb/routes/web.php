<?php

use App\companies;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('superadmin/companies', 'CompanyController');
Route::resource('superadmin/users', 'UserController');
Route::resource('superadmin/degrees', 'DegreeController');
Route::resource('superadmin/programs', 'ProgramController');
Route::resource('superadmin/subjects', 'SubjectController');
Route::resource('superadmin/roles', 'RoleController');
Route::resource('superadmin/company_programs', 'CompanyProgramController');
Route::resource('superadmin/pages', 'PageController');
Route::resource('superadmin/user_pages_list', 'UserPageController');

//Route::get('get_program', 'SubjectController@get_program');
