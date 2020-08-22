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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login','login_controller@login')->name('login');
Route::post('login','login_controller@login_process')->name('login_process');

Route::get('login_teacher','login_teacher_controller@login_teacher')->name('login_teacher');
Route::post('login_teacher','login_teacher_controller@login_teacher_process')->name('login_teacher_process');

// Route::get('index','login_controller@index')->name('index');
Route::get('logout','login_controller@logout')->name('logout');

Route::get('logout_teacher','login_teacher_controller@logout_teacher')->name('logout_teacher');

Route::group(['prefix'=>'login_controller','as'=>'login_controller.'],function() {
    Route::get('index','statistical_controller@index')->name('index');
});

Route::group(['prefix'=>'academic_year_management','as'=>'academic_year_management.','middleware'=>['CheckLogin']],function() {
    Route::get('academic_year_list','academic_year_controller@academic_year_list')->name('academic_year_list');
    Route::get('academic_year_insert','academic_year_controller@academic_year_insert')->name('academic_year_insert');
    Route::post('academic_year_insert','academic_year_controller@academic_year_insert_process')->name('academic_year_insert_process');
    Route::get('academic_year_update/{academic_year_id}','academic_year_controller@academic_year_update')->name('academic_year_update');
    Route::post('academic_year_update/{academic_year_id}','academic_year_controller@academic_year_update_process')->name('academic_year_update_process');
});

Route::group(['prefix'=>'pathway_management','as'=>'pathway_management.','middleware'=>['CheckLogin']],function() {
    Route::get('pathway_list','pathway_controller@pathway_list')->name('pathway_list');
    Route::get('pathway_insert','pathway_controller@pathway_insert')->name('pathway_insert');
    Route::post('pathway_insert','pathway_controller@pathway_insert_process')->name('pathway_insert_process');
    Route::get('pathway_update/{pathway_id}','pathway_controller@pathway_update')->name('pathway_update');
    Route::post('pathway_update/{pathway_id}','pathway_controller@pathway_update_process')->name('pathway_update_process');
});

Route::group(['prefix'=>'subject_management','as'=>'subject_management.','middleware'=>['CheckLogin']],function() {
    Route::get('subject_list','subject_controller@subject_list')->name('subject_list');
    Route::get('subject_insert','subject_controller@subject_insert')->name('subject_insert');
    Route::post('subject_insert','subject_controller@subject_insert_process')->name('subject_insert_process');
    Route::get('subject_update/{subject_id}','subject_controller@subject_update')->name('subject_update');
    Route::post('subject_update/{subject_id}','subject_controller@subject_update_process')->name('subject_update_process');
});

Route::group(['prefix'=>'pathway_subject_management','as'=>'pathway_subject_management.','middleware'=>['CheckLogin']],function() {
    Route::get('ps_list','pathway_subject_controller@ps_list')->name('ps_list');
    Route::get('insert','pathway_subject_controller@insert')->name('insert');
    Route::post('insert','pathway_subject_controller@insert_process')->name('insert_process');
});

Route::group(['prefix'=>'classes_management','as'=>'classes_management.','middleware'=>['CheckLogin']],function() {
    Route::get('choose_pathway_academic_year','classes_controller@choose_pathway_academic_year')->name('choose_pathway_academic_year');
    Route::get('class_insert','classes_controller@class_insert')->name('class_insert');
    Route::post('class_insert','classes_controller@class_insert_process')->name('class_insert_process');
    Route::get('class_update/{class_id}','classes_controller@class_update')->name('class_update');
    Route::post('class_update/{class_id}','classes_controller@class_update_process')->name('class_update_process');
});

Route::group(['prefix'=>'student_management','as'=>'student_management.','middleware'=>['CheckLogin']],function() {
    Route::get('list_student','student_controller@list_student')->name('list_student');
    Route::get('student_insert','student_controller@student_insert')->name('student_insert');
    Route::post('student_insert','student_controller@student_insert_process')->name('student_insert_process');
    // excel
    Route::get('student_insert_excel','student_controller@student_insert_excel')->name('student_insert_excel');
    Route::post('student_process_insert_excel','student_controller@student_process_insert_excel')->name('student_process_insert_excel');
    Route::get('student_update/{student_id}','student_controller@student_update')->name('student_update');
    Route::post('student_update/{student_id}','student_controller@student_update_process')->name('student_update_process');
});

Route::group(['prefix'=>'mark_management','as'=>'mark_management.','middleware'=>['CheckLogin']],function() {
    Route::get('choose_class_subject','mark_controller@choose_class_subject')->name('choose_class_subject');
    Route::get('list_mark','mark_controller@list_mark')->name('list_mark');
    Route::post('list_mark','mark_controller@process_mark')->name('process_mark');

});

Route::group(['prefix'=>'teacher_management','as'=>'teacher_management.','middleware'=>['CheckLogin']],function() {
    Route::get('teacher_list','teacher_controller@teacher_list')->name('teacher_list');
    Route::get('teacher_insert','teacher_controller@teacher_insert')->name('teacher_insert');
    Route::post('teacher_insert','teacher_controller@teacher_insert_process')->name('teacher_insert_process');
    Route::get('teacher_update/{email}','teacher_controller@teacher_update')->name('teacher_update');
    Route::post('teacher_update/{email}','teacher_controller@teacher_update_process')->name('teacher_update_process');
});

Route::group(['prefix'=>'ajax','as'=>'ajax.'],function() {
    Route::get('get_class_by_pathway_academic_year','classes_controller@get_class_by_pathway_academic_year')->name('get_class_by_pathway_academic_year');
    Route::get('get_student_by_class','student_controller@get_student_by_class')->name('get_student_by_class');
    Route::get('get_class_by_pathway_academic_year_insert','student_controller@get_class_by_pathway_academic_year_insert')->name('get_class_by_pathway_academic_year_insert');
    Route::get('get_subjectps','pathway_subject_controller@get_subjectps')->name('get_subjectps');
    Route::get('get_subject_by_pathway','statistical_controller@get_subject_by_pathway')->name('get_subject_by_pathway');
    Route::get('get_number_student','statistical_controller@get_number_student')->name('get_number_student');
    Route::get('get_subject','mark_controller@get_subject')->name('get_subject');
    Route::get('get_subject1','mark_view_controller@get_subject1')->name('get_subject1');

    Route::get('submit_mark','mark_controller@submit_mark')->name('submit_mark');
    
});

Route::group(['prefix'=>'mark','as'=>'mark.','middleware'=>['checkLoginOfTeacher']],function() {
    Route::get('mark_view','mark_view_controller@mark_view')->name('mark_view');
    Route::get('list_mark','mark_view_controller@list_mark')->name('list_mark');
});


// page student
Route::get('login_student','login_student_controller@login_student')->name('login_student');
Route::post('login_student','login_student_controller@login_student_process')->name('login_student_process');
Route::get('logout_student','login_student_controller@logout_student')->name('logout_student');
Route::group(['prefix'=>'student_login','as'=>'student_login.','middleware'=>['CheckLoginOfStudent']],function()
	{
		Route::get('hello_student','login_student_controller@hello_student')->name('hello_student');
    });
    
Route::group(['prefix'=>'student','as'=>'student.','middleware'=>['CheckLoginOfStudent']],function()
{
    Route::get('view_information','student_view_controller@view_information')->name('view_information');
    Route::post('change_information','student_view_controller@change_information')->name('change_information');
    Route::get('change_password','student_view_controller@change_password')->name('change_password');
    Route::post('change_password/{student_id}','student_view_controller@change_password_process')->name('change_password_process');

});

Route::group(['prefix'=>'student_view_mark','as'=>'student_view_mark.','middleware'=>['CheckLoginOfStudent']],function()
	{
		Route::get('view_mark','student_mark_controller@view_mark')->name('view_mark');
	});

//search
Route::group(['prefix'=>'search','as'=>'search.','middleware'=>['CheckLoginOfStudent']],function()
	{
		Route::get('search_subject','student_mark_controller@search_subject')->name('search_subject');
	});