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
Route::resource('/unauthorizedAlert', 'AuthorizationCheckController');

//Routes for Super Admins. This routes can only be accessed by a super admin.
Route::resource('superadmin/companies', 'CompanyController');
Route::resource('superadmin/users', 'UserController');
Route::resource('superadmin/roles', 'RoleController');
Route::resource('superadmin/degrees', 'DegreeController');
Route::resource('superadmin/programs', 'ProgramController');
Route::resource('superadmin/topics', 'TopicController');
Route::resource('superadmin/company_programs', 'CompanyProgramController');
Route::resource('superadmin/company_program_subjects', 'CompanyProgramSubjectController');


Route::resource('superadmin/subjects', 'SubjectController');
Route::resource('superadmin/chapters', 'ChapterController');
Route::post('superadmin/chapters/store', 'ChapterController@store');
Route::post('/company_program_subjects/store', 'CompanyProgramSubjectController@store');

//end routes for indexes

//chapter routes

Route::get('/chapters/fetchChapter', 'ChapterController@fetchChapter');
Route::post('superadmin/chapters/update', 'ChapterController@update');

Route::resource('superadmin/question_types', 'QuestionTypeController');

Route::resource('superadmin/questions', 'QuestionController');

//start route for dropdowns

Route::get('/programs/getProgramAccordingToCompany', 'ProgramController@getProgramAccordingToCompany');
Route::get('/subjects/getSubjectAccordingToProgram', 'SubjectController@getSubjectAccordingToProgram');
Route::get('/subjects/getSubjectAccordingToCompany', 'SubjectController@getSubjectAccordingToCompany');
Route::get('/chapters/getChapterAccordingToSubject', 'ChapterController@getChapterAccordingToSubject');
Route::get('/topics/getTopicAccordingToChapter', 'TopicController@getTopicAccordingToChapter');
Route::get('/topics/getChapterAccordingToSubject', 'TopicController@getChapterAccordingToSubject');


//End routes for dropdowns

Route::resource('superadmin/pages', 'PageController');
Route::resource('superadmin/user_pages_list', 'UserPageController');
Route::get('superadmin/user_pages_list/{{company->id}}', 'UserPageController@show');
//Route::get('get_program', 'SubjectController@get_program');



//Routes for users of a company. This routes can only be accessed by users of a company

Route::resource('user/subjects', 'SubjectController');
Route::resource('user/chapters', 'ChapterController');
Route::resource('user/topics', 'TopicController');



//Search Routes

Route::get('/users/searchUsers', 'SearchController@searchUsers');
Route::get('/subjects/searchSubjects', 'SearchController@searchSubjects');


//post Routes

Route::get('/questions/store', 'QuestionController@store');


//Get Role According To Present User's Role Route

Route::get('/roles/getRoleAccordingToPresentUsersRole', 'RoleController@getRoleAccordingToPresentUsersRole');


//Update Routes

Route::put('/chapters/update', 'ChapterController@update');