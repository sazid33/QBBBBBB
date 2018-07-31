<?php

use App\companies;
use App\Company;

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

//Routes for Super Admins. This routes can only be accessed by a super admin.
Route::resource('superadmin/companies', 'CompanyController');
Route::resource('superadmin/users', 'UserController');
Route::resource('superadmin/roles', 'RoleController');
Route::resource('superadmin/degrees', 'DegreeController');
Route::resource('superadmin/programs', 'ProgramController');

Route::resource('superadmin/company_programs', 'CompanyProgramController');

Route::resource('superadmin/subjects', 'SubjectController');
Route::resource('superadmin/chapters', 'ChapterController');
Route::post('superadmin/chapters/store', 'ChapterController@store');

//Ajax chapter routes

Route::get('/chapters/fetchChapter', 'ChapterController@fetchChapter');
Route::post('superadmin/chapters/update', 'ChapterController@update');



Route::resource('superadmin/topics', 'TopicController');
Route::get('/topics/getChapterAccordingToSubject', 'TopicController@getChapterAccordingToSubject');


Route::resource('superadmin/pages', 'PageController');
Route::resource('superadmin/user_pages_list', 'UserPageController');
Route::get('superadmin/user_pages_list/{{company->id}}', 'UserPageController@show');
//Route::get('get_program', 'SubjectController@get_program');



//Routes for users of a company. This routes can only be accessed by users of a company

Route::resource('user/subjects', 'SubjectController');
Route::resource('user/chapters', 'ChapterController');
Route::resource('user/topics', 'TopicController');